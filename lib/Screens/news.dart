import 'dart:async';
import 'dart:convert';
import 'package:date_format/date_format.dart';
import 'package:hotelhelpdesk/Other/services/Constants.dart';
import 'package:hotelhelpdesk/Screens/Login/components/body.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:hotelhelpdesk/Models/New.dart';
import 'package:hotelhelpdesk/Other/services/Jsondata.dart';
import 'package:hotelhelpdesk/Screens/detail.dart';
import 'package:intl/intl.dart';
import 'package:buddhist_datetime_dateformat/buddhist_datetime_dateformat.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:transparent_image/transparent_image.dart';
import 'package:hotelhelpdesk/Other/constants.dart';

class News extends StatefulWidget {
  @override
  _NewsState createState() => _NewsState();
}

class _NewsState extends State<News> {
  SharedPreferences sharedPreferences;
  final double _borderRadius = 24;
  int _currentMax = 10;
  var max;
  var min;
  var formatter = DateFormat.yMd().add_jm();
  ScrollController _scrollController = new ScrollController();
  List<New> _new;
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
    Jsondata.getNew().then((news) {
      setState(() {
        _new = news;
        max = _new.length;
        // _new = List.generate(10, (index) => _new[index]);
        min = _new.length;
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
        Jsondata.getNew().then((news) {
          setState(() {
            _new = news;
            _new.add(_new[i]);
            _new.length = max;
            _loading = false;
            if (_new.isNotEmpty) {
              return _new.elementAt(0);
            }
          });
        });
      }
      if (_new.length == max) {
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
            _loading ? 'Loading...' : "HMS System",
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
          itemCount: null == _new ? 0 : _new.length + 1,
          itemExtent: 100,
          itemBuilder: (context, index) {
            if (_new.length == 0 || _new.length == null) {
              return Center(
                child: Text(
                  "No Result",
                  style: TextStyle(color: Colors.white70, fontSize: 20),
                ),
              );
            } else {
              if (index == _new.length && _new.length > 10 && index > 10) {
                return Center(
                    child: CircularProgressIndicator(
                  backgroundColor: Colors.white70,
                ));
              } else if (index == _new.length &&
                  _new.length <= 10 &&
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
                                      "No.Room : " + _new[index].noRoom,
                                      style: TextStyle(
                                          color: Colors.black87,
                                          fontWeight: FontWeight.w700),
                                    ),
                                    SizedBox(
                                      height: 16,
                                    ),
                                    Text(
                                      "SUBJECT : " + _new[index].subject,
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
                                    "STATUS : " + _new[index].issName,
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
                                            _new[index].createdAt),
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
                      builder: (context) => IssuesNewDetail(_new[index])),
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

  Widget _logo() => Padding(
        padding: EdgeInsets.only(top: 10),
        child: FadeInImage.memoryNetwork(
            placeholder: kTransparentImage,
            width: MediaQuery.of(context).size.width * 0.8,
            image:
                "https://lh3.googleusercontent.com/proxy/655Uyo1QEUIC4pMiTxratrOddB7f4Mmmtw3Rs7nn93jixlzxbapGlUgzCtK4viBT_Qw9IddixkzU-W6xVfUqPgYL80NpDA9Q12DItYVfDsa4HCXazIt4SFXbxe-SaYXDwHDbx1lE"),
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
        Jsondata.getNew().then((news) {
          setState(() {
            _new = news;
            max = _new.length;
            // _new = List.generate(10, (index) => _new[index]);
            min = _new.length;
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
