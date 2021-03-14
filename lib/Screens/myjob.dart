import 'dart:async';
import 'dart:convert';
import 'package:date_format/date_format.dart';
import 'package:hotelhelpdesk/Other/services/Constants.dart';
import 'package:hotelhelpdesk/Screens/Login/components/body.dart';
import 'package:hotelhelpdesk/Screens/detail.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:hotelhelpdesk/Models/Myjob.dart';
import 'package:hotelhelpdesk/Other/constants.dart';
import 'package:hotelhelpdesk/Other/services/Jsondata.dart';
import 'package:intl/intl.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:buddhist_datetime_dateformat/buddhist_datetime_dateformat.dart';


class Job extends StatefulWidget {
  @override
  _JobState createState() => _JobState();
}

class _JobState extends State<Job> {
  SharedPreferences sharedPreferences;
  final double _borderRadius = 24;
  int _currentMax = 10;
  var max;
  var min;
  var formatter = DateFormat.yMd().add_jm();
  ScrollController _scrollController = new ScrollController();
  List<Myjob> _myjob;
  bool _loading;
  DateTime time = DateTime.now();
  bool _disposed = false;

  @override
  void initState() {
    super.initState();
    checkLoginStatus();
    Timer(Duration(seconds: 1), () {
      if (!_disposed)
        setState(() {
          time = time.add(Duration(seconds: -1));
        });
    });
    _loading = true;
    Jsondata.getMyjob().then((myjob) {
      setState(() {
        _myjob = myjob;
        max = _myjob.length;
        // _new = List.generate(10, (index) => _new[index]);
        min = _myjob.length;
        _scrollController.addListener(() {
          if (_scrollController.position.pixels ==
              _scrollController.position.maxScrollExtent) {
            getMoreData();
          }
        });
        _loading = false;
      });
    });

    // print(_new.length.toString());
  }

  @override
  void dispose() {
    // TODO: implement dispose
    _scrollController.dispose();
    _disposed = true;
    super.dispose();
  }

  showAlertNullData() async {
    showDialog(
        context: context,
        barrierDismissible: false,
        builder: (context) {
          return AlertDialog(
            title: Text("ไม่มีข้อมูลของงานใหม่"),
            actions: [
              FlatButton(
                onPressed: () {
                  Navigator.pop(context);
                },
                child: Text("OK"),
              ),
            ],
          );
        });
  }

  getMoreData() {
    if (min == 10) {
      for (int i = _currentMax; i < max - 1; i++) {
        Jsondata.getMyjob().then((myjob) {
          setState(() {
            _myjob = myjob;
            _myjob.add(_myjob[i]);
            _myjob.length = max;
            _loading = false;
            if (_myjob.isNotEmpty) {
              return _myjob.elementAt(0);
            }
          });
        });
      }
      if (_myjob.length == max) {
        showAlertLimitData();
      }
    }
    setState(() {});
  }

  showAlertLimitData() async {
    showDialog(
        context: context,
        barrierDismissible: false,
        builder: (context) {
          return AlertDialog(
            title: Text("ข้อมูลสิ้นสุดแค่นี้"),
            actions: [
              FlatButton(
                onPressed: () {
                  Navigator.pop(context);
                },
                child: Text("OK"),
              ),
            ],
          );
        });
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
            _loading = false;
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
            title: Text("Token ของท่านหมดอายุกรุณาทำการล็อคอินใหม่"),
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

  @override
  Widget build(BuildContext context) {
    return SafeArea(
      child: Scaffold(
        appBar: AppBar(
          centerTitle: true,
          title: Text(
            _loading ? 'Loading...' :"HMS System",
          ),
          backgroundColor: Colors.white,
          elevation: 6.0,
          shape: ContinuousRectangleBorder(
            borderRadius: const BorderRadius.only(
              bottomLeft: Radius.circular(60.0),
              bottomRight: Radius.circular(60.0),
            ),
          ),
          actions: [
            IconButton(
              icon: Icon(Icons.refresh),
              onPressed: () {
                _handleRefresh();
              },
            ),
          ],
        ),
        backgroundColor: kPrimaryColor,
        body: (_loading
            ? new Center(
            child: new CircularProgressIndicator(
              backgroundColor: Colors.white70,
            ))
            : _showJsondata()),
      ),
    );
  }

  Widget _showJsondata() => new RefreshIndicator(
    child: ListView.builder(
      controller: _scrollController,
      scrollDirection: Axis.vertical,
      itemCount: null == _myjob ? 0 : _myjob.length + 1,
      itemExtent: 100,
      itemBuilder: (context, index) {
        if (_myjob.length == 0 || _myjob.length == null) {
          return Center(
            child: Text(
              "No Result",
              style: TextStyle(color: Colors.white70, fontSize: 20),
            ),
          );
        } else {
          if (index == _myjob.length && _myjob.length > 10 && index > 10) {
            return Center(
                child: CircularProgressIndicator(
                  backgroundColor: Colors.white70,
                ));
          } else if (index == _myjob.length &&
              _myjob.length <= 10 &&
              index <= 10) {
            return Center(child: Text(""));
          }
        }
        // New _new[index] = _new[index];
        return GestureDetector(
          child: Center(
            child: Padding(
              padding: const EdgeInsets.all(10.0),
              child: Stack(
                children: <Widget>[
                  Container(
                    height: 120,
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(_borderRadius),
                      color: Colors.white,
                      // Color(0xFFf2f6f5),
                      // gradient: LinearGradient(
                      //   colors: [Color(0xFF34558b), Colors.lightBlue],
                      //   begin: Alignment.topLeft,
                      //   end: Alignment.bottomRight,
                      // ),
                    ),
                  ),
                  Positioned.fill(
                    child: Row(
                      children: <Widget>[
                        // Expanded(
                        //   child: imageTrack(index),
                        //   // Image.asset(
                        //   //   'assets/mac-os.png',
                        //   //   height: 40,
                        //   //   width: 40,
                        //   // ),
                        //   flex: 2,
                        // ),
                        Expanded(
                          flex: 4,
                          child: Padding(
                            padding: EdgeInsets.only(left: 20),
                            child: Column(
                              mainAxisSize: MainAxisSize.min,
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: <Widget>[
                                Text(
                                  "No.Room : " + _myjob[index].noRoom,
                                  style: TextStyle(
                                      color: Colors.black87,
                                      fontWeight: FontWeight.w700),
                                ),
                                SizedBox(
                                  height: 16,
                                ),
                                Text(
                                  "SUBJECT : " + _myjob[index].subject,
                                  overflow: TextOverflow.ellipsis,
                                  style: TextStyle(
                                      color: Colors.black45,
                                      fontWeight: FontWeight.w700),
                                ),
                              ],
                            ),
                          ),
                        ),
                        Expanded(
                          flex: 8,
                          child: Column(
                            mainAxisSize: MainAxisSize.min,
                            children: <Widget>[
                              Text(
                                "STATUS : " + _myjob[index].issName,
                                style: TextStyle(
                                    color: Colors.black87,
                                    fontWeight: FontWeight.w700),
                              ),
                              SizedBox(
                                height: 16,
                              ),
                              Text(
                                "Createat : " +
                                    formatter.formatInBuddhistCalendarThai(
                                        _myjob[index].createdAt),
                                style: TextStyle(
                                    color: Colors.black45,
                                    fontWeight: FontWeight.w700),
                              ),
                            ],
                          ),
                        ),
                        Icon(
                          Icons.keyboard_arrow_right,
                          color: Colors.black87,
                          size: 30,
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          ),
          onTap: () {
            Navigator.push(
              context,
              MaterialPageRoute(
                  builder: (context) => IssuesMyjobDetail(_myjob[index])),
            ).then((value) {
              setState(() {
                _handleRefresh();
              });
            });
          },
        );
      },
    ),
    onRefresh: _handleRefresh,
  );


  Future<Null> _handleRefresh() async {
    Completer<Null> completer = new Completer<Null>();

    new Future.delayed(new Duration(milliseconds: 2)).then((_) {
      completer.complete();
      setState(() {
        Timer(Duration(seconds: 1), () {
          if (!_disposed)
            setState(() {
              time = time.add(Duration(seconds: -1));
            });
        });
        _loading = true;
        Jsondata.getMyjob().then((myjob) {
          setState(() {
            _myjob = myjob;
            max = _myjob.length;
            // _new = List.generate(10, (index) => _new[index]);
            min = _myjob.length;
            _scrollController.addListener(() {
              if (_scrollController.position.pixels ==
                  _scrollController.position.maxScrollExtent) {
                getMoreData();
              }
            });
            _loading = false;
          });
        });
      });
    });

    return null;
  }
}
