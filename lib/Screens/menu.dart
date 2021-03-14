import 'dart:convert';

import 'package:date_format/date_format.dart';
import 'package:flutter/material.dart';
import 'package:hotelhelpdesk/Other/constants.dart';
import 'package:hotelhelpdesk/Other/services/Constants.dart';
import 'package:hotelhelpdesk/Screens/Login/components/body.dart';
import 'package:hotelhelpdesk/Screens/Login/login_screen.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:http/http.dart' as http;

class Menu extends StatefulWidget {
  @override
  _MenuState createState() => _MenuState();
}

class _MenuState extends State<Menu> {

  SharedPreferences sharedPreferences;
  String _username;
  String _name;
  String _team;
  String _version = "";
  bool _isLoading;
  String Url;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    checkLoginStatus();
    _settingsection();
  }

  checkLoginStatus() async {
    sharedPreferences = await SharedPreferences.getInstance();
    if (sharedPreferences.getString("token") != null) {
      Map data = {
        'token': sharedPreferences.getString("token"),
      };
      var jsonData = null;
      var response = await http.post(
          '${ApiUrl}'+"/api/issues-delete",
          body: data);
      if (response.statusCode == 200) {
        jsonData = json.decode(response.body);
        if (jsonData != null) {
          setState(() {
            _isLoading = false;
            String exp =
            sharedPreferences.getString("expires_at").replaceAll(" ", "").replaceAll(":", "").replaceAll("-", "");
            // print(exp);
            var expired = int.parse(exp);
            var now = int.parse(
                formatDate(DateTime.now(), [dd, mm, yyyy, HH, nn, ss]));
            // print(expired);
            // print(now);
            if (expired < now) {
              sharedPreferences.clear();
              sharedPreferences.commit();
              showTokenAlert();
            }
          });
        }
      } else if (sharedPreferences.getString("token") == null) {
        sharedPreferences.clear();
        sharedPreferences.commit();
        Navigator.of(context).pushAndRemoveUntil(
            MaterialPageRoute(builder: (BuildContext context) => Body()),
                (Route<dynamic> route) => false);
      }
    }
  }

  showTokenAlert() async {
    showDialog(
        context: context,
        barrierDismissible: false,
        builder: (context) {
          return AlertDialog(
            title: Text("Token หมดอายุกรุณาทำการล็อคอินใหม่"),
            actions: [
              FlatButton(
                onPressed: () {
                  sharedPreferences.clear();
                  sharedPreferences.commit();
                  Navigator.of(context).pushAndRemoveUntil(
                      MaterialPageRoute(
                          builder: (BuildContext context) => Body()),
                          (Route<dynamic> route) => false);
                },
                child: Text("OK"),
              ),
            ],
          );
        });
  }

  _launchURL() async {
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    String url = sharedPreferences.getString("url");
    if (await canLaunch(url)) {
      await launch(url);
    } else {
      throw 'Could not launch $url';
    }
  }

  Future<void> _settingsection() async {
    sharedPreferences = await SharedPreferences.getInstance();
    final String username = sharedPreferences.getString("username");
    final String name = sharedPreferences.getString("name");
    final String team = sharedPreferences.getString("team");
    setState(() {
      _username = username;
      _name = name;
      _team = team;
    });
    // print(imageAvatar());
    // print(sharedPreferences.getString("image").toString().substring(9).replaceAll("}]", ""));
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text(
          "HMS System",
        ),
        backgroundColor: Colors.white,
        elevation: 6.0,
        shape: ContinuousRectangleBorder(
          borderRadius: const BorderRadius.only(
            bottomLeft: Radius.circular(60.0),
            bottomRight: Radius.circular(60.0),
          ),
        ),
      ),
      backgroundColor: kPrimaryColor,
      body: ListView(
        children: <Widget>[
          Card(
            margin: EdgeInsets.only(top: 30, left: 30, right: 30),
            color: Colors.white,
            child: Padding(
              padding: EdgeInsets.all(8.0),
              child: Container(
                child: Form(
                  child: Center(
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.start,
                      children: <Widget>[
                        Container(
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: <Widget>[
                              Container(
                                child: Column(
                                  children: <Widget>[
                                    Padding(
                                      padding: const EdgeInsets.all(8.0),
                                      child: CircleAvatar(
                                        backgroundColor: Colors.transparent,
                                        radius: 30.0,
                                        backgroundImage: Url == null
                                            ? NetworkImage(
                                          // "https://cdn.icon-icons.com/icons2/1674/PNG/512/person_110935.png")
                                            "https://media1.tenor.com/images/82c6e055245fc8fa7381dc887bf14e62/tenor.gif?itemid=12170592")
                                            : NetworkImage('${Url}'),
                                        // // backgroundImage: NetworkImage("http://cnmihelpdesk.rama.mahidol.ac.th/storage/"+image),
                                        //
                                        // // child: Image,
                                      ),
                                    ),
                                    Padding(
                                      padding: const EdgeInsets.only(
                                          top: 16, left: 16, right: 16),
                                      child: Text(
                                        "Username : "
                                        +'${_username}',
                                        style: TextStyle(
                                            fontWeight: FontWeight.bold),
                                      ),
                                    ),
                                    Padding(
                                      padding: const EdgeInsets.only(
                                          top: 16, left: 16, right: 16),
                                      child: Text(
                                        "Name : "
                                        +'${_name}',
                                        style: TextStyle(
                                            fontWeight: FontWeight.bold),
                                      ),
                                    ),
                                    Padding(
                                      padding: const EdgeInsets.only(
                                          top: 16, left: 16, right: 16),
                                      child: Text(
                                        "Team : "
                                        +'${_team}',
                                        style: TextStyle(
                                            fontWeight: FontWeight.bold),
                                      ),
                                    ),
                                    // Container(
                                    //   width: MediaQuery.of(context).size.width,
                                    //   height: 40.0,
                                    //   margin: EdgeInsets.only(top: 30),
                                    //   padding: EdgeInsets.symmetric(
                                    //       horizontal: 20.0),
                                    //   child: RaisedButton.icon(
                                    //     color: Colors.amberAccent,
                                    //     onPressed: () {
                                    //       setState(() {
                                    //         // checkVersion();
                                    //       });
                                    //     },
                                    //     shape: RoundedRectangleBorder(
                                    //       borderRadius:
                                    //           BorderRadius.circular(5.0),
                                    //     ),
                                    //     icon: Icon(
                                    //       Icons.system_update,
                                    //       color: Colors.white70,
                                    //     ),
                                    //     label: Text(
                                    //       "CheckforUpdate v",
                                    //       // + _version,
                                    //       style:
                                    //           TextStyle(color: Colors.white70),
                                    //     ),
                                    //   ),
                                    // ),
                                    Container(
                                      width: MediaQuery.of(context).size.width,
                                      height: 40.0,
                                      margin: EdgeInsets.only(top: 10),
                                      padding: EdgeInsets.symmetric(
                                          horizontal: 20.0),
                                      child: RaisedButton(
                                        color: Colors.redAccent,
                                        onPressed: () {
                                          setState(() {
                                            _showLogoutAlertDialog();
                                          });
                                        },
                                        shape: RoundedRectangleBorder(
                                          borderRadius:
                                              BorderRadius.circular(5.0),
                                        ),
                                        child: Text(
                                          "Logout",
                                          style:
                                              TextStyle(color: Colors.white70),
                                        ),
                                      ),
                                    ),
                                  ],
                                ),
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }

  void _showLogoutAlertDialog() async {
    SharedPreferences _prefs = await SharedPreferences.getInstance();

    showDialog(
        context: context,
        barrierDismissible: false,
        builder: (context) {
          return AlertDialog(
            title: Text("${_prefs.getString("username")} ล็อคเอ้าท์"),
            content: Text("คุณต้องการล็อคเอ้าท์ใช่หรือไม่ ?"),
            actions: [
              FlatButton(
                onPressed: () {
                  _prefs.clear();
                  _prefs.commit();
                  return Navigator.of(context).pushAndRemoveUntil(
                    MaterialPageRoute(
                        builder: (BuildContext context) => LoginScreen()),
                        (Route<dynamic> route) => false,
                  );
                },
                child: Text("ใช่"),
              ),
              FlatButton(
                onPressed: () {
                  Navigator.pop(context);
                },
                child: Text("ไม่"),
              ),
            ],
          );
        });
  }

}
