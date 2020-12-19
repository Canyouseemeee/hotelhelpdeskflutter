import 'package:flutter/material.dart';
import 'package:hotelhelpdesk/Other/constants.dart';
import 'package:hotelhelpdesk/Screens/Login/login_screen.dart';
import 'package:shared_preferences/shared_preferences.dart';

class Menu extends StatefulWidget {
  @override
  _MenuState createState() => _MenuState();
}

class _MenuState extends State<Menu> {

  SharedPreferences sharedPreferences;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(
              "Menu",
            )
          ],
        ),
        backgroundColor: Colors.white,
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
                                        // backgroundImage: Url == null
                                        //     ? NetworkImage(
                                        //   // "https://cdn.icon-icons.com/icons2/1674/PNG/512/person_110935.png")
                                        //     "https://media1.tenor.com/images/82c6e055245fc8fa7381dc887bf14e62/tenor.gif?itemid=12170592")
                                        //     : NetworkImage('${Url}'),
                                        // // backgroundImage: NetworkImage("http://cnmihelpdesk.rama.mahidol.ac.th/storage/"+image),
                                        //
                                        // // child: Image,
                                      ),
                                    ),
                                    Padding(
                                      padding: const EdgeInsets.only(
                                          top: 16, left: 16, right: 16),
                                      child: Text(
                                        "Username : ",
                                        // +'${_username}',
                                        style: TextStyle(
                                            fontWeight: FontWeight.bold),
                                      ),
                                    ),
                                    Padding(
                                      padding: const EdgeInsets.only(
                                          top: 16, left: 16, right: 16),
                                      child: Text(
                                        "Name : ",
                                        // +'${_name}',
                                        style: TextStyle(
                                            fontWeight: FontWeight.bold),
                                      ),
                                    ),
                                    Padding(
                                      padding: const EdgeInsets.only(
                                          top: 16, left: 16, right: 16),
                                      child: Text(
                                        "Team : ",
                                        // +'${_team}',
                                        style: TextStyle(
                                            fontWeight: FontWeight.bold),
                                      ),
                                    ),
                                    Container(
                                      width: MediaQuery.of(context).size.width,
                                      height: 40.0,
                                      margin: EdgeInsets.only(top: 30),
                                      padding: EdgeInsets.symmetric(
                                          horizontal: 20.0),
                                      child: RaisedButton.icon(
                                        color: Colors.amberAccent,
                                        onPressed: () {
                                          setState(() {
                                            // checkVersion();
                                          });
                                        },
                                        shape: RoundedRectangleBorder(
                                          borderRadius:
                                              BorderRadius.circular(5.0),
                                        ),
                                        icon: Icon(
                                          Icons.system_update,
                                          color: Colors.white70,
                                        ),
                                        label: Text(
                                          "CheckforUpdate v",
                                          // + _version,
                                          style:
                                              TextStyle(color: Colors.white70),
                                        ),
                                      ),
                                    ),
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
