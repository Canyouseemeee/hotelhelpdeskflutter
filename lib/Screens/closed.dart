import 'package:flutter/material.dart';
import 'package:hotelhelpdesk/Other/constants.dart';

class Closed extends StatefulWidget {
  @override
  _ClosedState createState() => _ClosedState();
}

class _ClosedState extends State<Closed> {
  @override
  Widget build(BuildContext context) {
    return SafeArea(
      child: Scaffold(
        appBar: AppBar(
          title: Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Text(
                "Closed",
              )
            ],
          ),
          backgroundColor: Colors.white,
        ),
        backgroundColor: kPrimaryColor,
        body: Container(
          child: Text("Closed"),
        ),
      ),
    );
  }
}
