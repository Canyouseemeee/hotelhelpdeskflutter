import 'dart:async';
import 'dart:convert';
import 'package:hotelhelpdesk/Other/components/text_field_container.dart';
import 'package:hotelhelpdesk/Other/services/Constants.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:transparent_image/transparent_image.dart';
import 'package:hotelhelpdesk/Other/constants.dart';
import 'package:hotelhelpdesk/Screens/Home/home.dart';
import 'package:hotelhelpdesk/Screens/Login/components/background.dart';

class Body extends StatefulWidget {
  @override
  _BodyState createState() => _BodyState();
}

class _BodyState extends State<Body> {
  final _formKey = GlobalKey<FormState>();
  bool _isLoading = false;
  SharedPreferences sharedPreferences;
  bool _disposed = false;
  DateTime time = DateTime.now();

  checkLoginStatus() async {
    sharedPreferences = await SharedPreferences.getInstance();
    if (sharedPreferences.getString("token") != null) {
      Navigator.of(context).pushAndRemoveUntil(
          MaterialPageRoute(builder: (BuildContext context) => HomePage()),
              (Route<dynamic> route) => false);
    }
  }

  signIn(String username, String password) async {
    Map data = {'username': username, 'password': password};
    var jsonData = null;
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    var response =
        await http.post('${ApiUrl}'+"/api/login/", body: data);
    if (response.statusCode == 200) {
      jsonData = json.decode(response.body);
      // print(jsonData);
      if (jsonData != null) {
        setState(() {
          _isLoading = false;
        });
        sharedPreferences.setString("token", jsonData['token']);
        sharedPreferences.setString("username", username);
        sharedPreferences.setString("name", jsonData['name']);
        sharedPreferences.setString("image", jsonData['image']);
        sharedPreferences.setString("expires_at", jsonData['expires_at']);
        // postloginlog(sharedPreferences.getString("username"),
        //     sharedPreferences.getString("token"));
        sharedPreferences.setString("team", jsonData['team']);
        // print(sharedPreferences.getString('email'));
        Navigator.of(context).pushAndRemoveUntil(
            MaterialPageRoute(builder: (BuildContext context) => HomePage()),
            (Route<dynamic> route) => false);
      }
    } else {
      _showAlertDialog();
      // print(response.body);
    }
  }

  @override
  void initState() {
    // TODO: implement initState
    _isLoading = true;
    Timer(Duration(seconds: 5), () {
      if (!_disposed)
        setState(() {
          time = time.add(Duration(seconds: -1));
          _isLoading = false;
        });
    });
    checkLoginStatus();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Scaffold(
      body: (_isLoading
          ? new Center(
          child: new CircularProgressIndicator(
            backgroundColor: Colors.white70,
          ))
          : Background(
        child: SingleChildScrollView(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              Text(
                "HMS SYSTEM",
                style: TextStyle(fontWeight: FontWeight.bold,fontSize: 25.0),
              ),
              SizedBox(height: size.height * 0.03),
              FadeInImage.memoryNetwork(
                placeholder: kTransparentImage,
                image:
                "https://www.dru.ac.th/templates/users/dru2018_v1.0.0.4/assets/img/yellowhead/logo.png",
                width: size.width * 1,
                height: size.height * 0.35,
              ),
              SizedBox(height: size.height * 0.03),
              // RoundedInputField(
              //   hintText: "Your Username",
              //   onChanged: (value) {},
              // ),
              // RoundedPasswordField(
              //   onChanged: (value) {},
              // ),
              _buildUsernameInput(),
              _buildPasswordInput(),
              Container(
                width: MediaQuery.of(context).size.width * 0.8,
                // height: 40.0,
                margin: EdgeInsets.symmetric(vertical: 10),
                padding: EdgeInsets.symmetric(horizontal: 20.0),
                child: FlatButton(
                  color: kPrimaryColor,
                  padding:
                  EdgeInsets.symmetric(vertical: 20, horizontal: 40),
                  child:
                  Text("Login", style: TextStyle(color: Colors.white)),
                  onPressed: () {
                    // _submit();
                    if (usernameController.text != "") {
                      signIn(
                          usernameController.text, passwordController.text);
                    }
                  },
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(29),
                  ),
                ),
              ),
              SizedBox(height: size.height * 0.03),
            ],
          ),
        ),
      )),
    );
  }

  TextEditingController usernameController = new TextEditingController();
  TextEditingController passwordController = new TextEditingController();

  Widget _buildUsernameInput() => TextFieldContainer(
        child: TextFormField(
          cursorColor: kPrimaryColor,
          controller: usernameController,
          decoration: InputDecoration(
            labelText: 'Username',
            // hintText: 'Username',
            icon: Icon(Icons.person, color: kPrimaryColor),
            border: InputBorder.none,
          ),
          // validator: _validateUsername,
          onSaved: (String value) {},
          onFieldSubmitted: (String value) {},
        ),
      );

  Widget _buildPasswordInput() => TextFieldContainer(
        child: TextFormField(
          cursorColor: kPrimaryColor,
          controller: passwordController,
          decoration: InputDecoration(
            labelText: 'Password',
            icon: Icon(
              Icons.lock,
              color: kPrimaryColor,
            ),
            suffixIcon: Icon(
              Icons.visibility,
              color: kPrimaryColor,
            ),
            border: InputBorder.none,
          ),
          obscureText: true,
          // validator: _validatePassword,
          onSaved: (String value) {},
        ),
      );

  void _showAlertDialog() {
    showDialog(
        context: context,
        barrierDismissible: false,
        builder: (context) {
          return AlertDialog(
            title: Text("Username หรือ Password ไม่ถูกต้อง"),
            // content: Text("Are you sure"),
            actions: [
              FlatButton(
                onPressed: () {
                  usernameController.clear();
                  passwordController.clear();
                  Navigator.pop(context);
                },
                child: Text("OK"),
              ),
            ],
          );
        });
  }

  void _submit() {
    if (this._formKey.currentState.validate()) {}
  }
}
