import 'dart:async';

import 'package:flutter/material.dart';
import 'package:hotelhelpdesk/Other/constants.dart';

class Checkin extends StatefulWidget {
  @override
  _CheckinState createState() => _CheckinState();
}

class _CheckinState extends State<Checkin> {

  bool _loading;
  bool _disposed = false;
  DateTime time = DateTime.now();


  @override
  void initState() {
    _loading = true;
    Timer(Duration(seconds: 1), () {
      if (!_disposed)
        setState(() {
          _loading = false;
          time = time.add(Duration(seconds: -1));
        });
    });
    super.initState();

  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Align(
          alignment: Alignment.center,
          child: Padding(
              padding: EdgeInsets.only(right: 40),
              child: Text(_loading ? 'Loading...' : "Checkin-Checkout")),
        ),
        backgroundColor: Colors.white,
      ),
      body: (_loading
          ? new Center(
          child: new CircularProgressIndicator(
            // backgroundColor: Colors.white70,
          ))
          : _showJsondata()),
      bottomNavigationBar:
      SafeArea(
          child: Container(
            height: 60,
            color: Colors.green,
            child: InkWell(
              child: Padding(
                padding: EdgeInsets.only(top: 8.0),
                child: Column(
                  children: <Widget>[
                    Icon(
                      Icons.location_on,
                      color: Colors.white70,
                    ),
                    Text('Checkin')
                  ],
                ),
              ),onTap: (){
              // showAlertUpdate(news);
            },
            ),
          )),
      backgroundColor: kPrimaryColor,
    );
  }

  Widget _showJsondata() => new Text("Checkin");
}
