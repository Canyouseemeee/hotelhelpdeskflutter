import 'dart:async';
import 'dart:convert';
import 'package:hotelhelpdesk/Models/Closed.dart';
import 'package:hotelhelpdesk/Models/Myjob.dart';
import 'package:hotelhelpdesk/Models/New.dart';
import 'package:hotelhelpdesk/Other/constants.dart';
import 'package:hotelhelpdesk/Other/services/Constants.dart';
import 'package:hotelhelpdesk/Other/services/Jsondata.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:hotelhelpdesk/Models/Progress.dart';
import 'package:hotelhelpdesk/Screens/checkin_work.dart';
import 'package:hotelhelpdesk/Screens/comments.dart';
import 'package:intl/intl.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:buddhist_datetime_dateformat/buddhist_datetime_dateformat.dart';

class IssuesProgressDetail extends StatefulWidget {
  Progress_s progress;

  IssuesProgressDetail(this.progress);

  @override
  _IssuesProgressDetailState createState() =>
      _IssuesProgressDetailState(progress);
}

class _IssuesProgressDetailState extends State<IssuesProgressDetail> {
  Progress_s progress;

  _IssuesProgressDetailState(this.progress);

  String statuscheckin;
  String count;
  DateTime time = DateTime.now();
  bool _disposed = false;
  bool _loading;
  var formatter = DateFormat.yMd().add_jm();

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    _loading = true;
    Timer(Duration(seconds: 1), () {
      if (!_disposed)
        setState(() {
          time = time.add(Duration(seconds: -1));
        });
    });
    getCommentCount();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    _disposed = true;
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text(_loading ? 'Loading...' : "Detail"),
        backgroundColor: Colors.white,
        elevation: 6.0,
        shape: ContinuousRectangleBorder(
          borderRadius: const BorderRadius.only(
            bottomLeft: Radius.circular(60.0),
            bottomRight: Radius.circular(60.0),
          ),
        ),
      ),
      body: (_loading
          ? new Center(
              child: new CircularProgressIndicator(
              backgroundColor: Colors.white70,
            ))
          : ListView(
              children: <Widget>[
                _titleSection(context),
              ],
            )),
      backgroundColor: kPrimaryColor,
    );
  }

  getCommentCount() async {
    Map data = {'issuesid': progress.issuesid.toString()};
    var jsonData = null;
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    var response = await http.post(
        '${ApiUrl}'+"/api/issues-getcountComment",
        body: data);
    if (response.statusCode == 200) {
      jsonData = json.decode(response.body);
      if (jsonData != null) {
        setState(() {
          _loading = false;
          sharedPreferences.setString('count', jsonData['count'].toString());
          count = sharedPreferences.getString('count');
        });
      }
    } else {
      print(response.body);
    }
  }

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
        Jsondata.getProgress().then((news) {
          setState(() {
            _loading = false;
          });
        });
      });
    });

    return null;
  }

  Widget _titleSection(context) => Padding(
        padding: EdgeInsets.all(0),
        child: Card(
          child: Padding(
            padding: EdgeInsets.only(left: 8),
            child: Column(
              children: <Widget>[
                SizedBox(
                  height: 16,
                ),
                Row(
                  children: <Widget>[
                    Padding(
                      padding: EdgeInsets.only(left: 150),
                      child: Align(
                        alignment: Alignment.center,
                        child: Text(
                          "Issuesid : " + progress.issuesid.toString(),
                          style: TextStyle(fontWeight: FontWeight.w500),
                        ),
                      ),
                    ),
                    Padding(
                      padding: EdgeInsets.only(left: 50),
                      child: RaisedButton(
                        color: Colors.green,
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) =>
                                    Checkin(progress.issuesid.toString())),
                          ).then((value) {
                            setState(() {
                              _handleRefresh();
                            });
                          });
                        },
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(30.0),
                        ),
                        child: Text(
                          "CheckIn",
                          style: TextStyle(color: Colors.white70),
                        ),
                      ),
                    ),
                  ],
                ),
                SizedBox(
                  height: 16,
                ),
                Divider(
                  thickness: 1,
                  color: Colors.grey,
                  endIndent: 10,
                ),
                Row(
                  children: <Widget>[
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "No.Room = " + progress.noRoom,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "TYPE = " + progress.typename,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                        ],
                      ),
                    ),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.stretch,
                        children: [
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "STATUS = " + progress.issName,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "Assignment = " + progress.assignment,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
                SizedBox(
                  height: 16,
                ),
                Divider(
                  thickness: 1,
                  color: Colors.grey,
                  endIndent: 10,
                ),
                Row(
                  children: <Widget>[
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: <Widget>[
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "SUBJECT = " + progress.subject.toString(),
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "DESCRIPTION = " + progress.description,
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
                Divider(
                  thickness: 1,
                  color: Colors.grey,
                  endIndent: 10,
                ),
                Row(
                  children: <Widget>[
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "Createby = " + progress.createby,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "UpdateBy = " + progress.updatedby,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.stretch,
                        children: <Widget>[
                          Text(
                            "Created = " +
                                formatter.formatInBuddhistCalendarThai(
                                    progress.createdAt),
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "Updated = " +
                                formatter.formatInBuddhistCalendarThai(
                                    progress.updatedAt),
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
                Center(
                  child: Container(
                    width: MediaQuery.of(context).size.width,
                    height: 50.0,
                    margin: EdgeInsets.all(10),
                    padding: EdgeInsets.symmetric(horizontal: 80.0),
                    child: RaisedButton(
                      color: Colors.pink,
                      onPressed: () {
                        setState(() {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) =>
                                    Comment(progress.issuesid.toString())),
                          ).then((value) {
                            setState(() {
                              _handleRefresh();
                              getCommentCount();
                            });
                          });
                        });
                      },
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(30.0),
                      ),
                      child: Text(
                        "Comment (" + count + ")",
                        style: TextStyle(color: Colors.white70),
                      ),
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      );
}

//Todo new
class IssuesNewDetail extends StatefulWidget {
  New news;

  IssuesNewDetail(this.news);

  @override
  _IssuesNewDetailState createState() => _IssuesNewDetailState(news);
}

class _IssuesNewDetailState extends State<IssuesNewDetail> {
  New news;

  _IssuesNewDetailState(this.news);

  String statuscheckin;
  String count;
  DateTime time = DateTime.now();
  bool _disposed = false;
  bool _loading;
  var formatter = DateFormat.yMd().add_jm();

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    _loading = true;
    Timer(Duration(seconds: 1), () {
      if (!_disposed)
        setState(() {
          time = time.add(Duration(seconds: -1));
        });
    });
    getCommentCount();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    _disposed = true;
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text(_loading ? 'Loading...' : "Detail"),
        backgroundColor: Colors.white,
        elevation: 6.0,
        shape: ContinuousRectangleBorder(
          borderRadius: const BorderRadius.only(
            bottomLeft: Radius.circular(60.0),
            bottomRight: Radius.circular(60.0),
          ),
        ),
      ),
      body: (_loading
          ? new Center(
              child: new CircularProgressIndicator(
              backgroundColor: Colors.white70,
            ))
          : ListView(children: <Widget>[
              _titleSection(context),
            ])),
      backgroundColor: kPrimaryColor,
    );
  }

  getCommentCount() async {
    Map data = {'issuesid': news.issuesid.toString()};
    var jsonData = null;
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    var response = await http.post(
        '${ApiUrl}'+"/api/issues-getcountComment",
        body: data);
    if (response.statusCode == 200) {
      jsonData = json.decode(response.body);
      if (jsonData != null) {
        setState(() {
          _loading = false;
          sharedPreferences.setString('count', jsonData['count'].toString());
          count = sharedPreferences.getString('count');
        });

      }
    } else {
      print(response.body);
    }
  }

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
            _loading = false;
          });
        });
      });
    });

    return null;
  }

  Widget _titleSection(context) => Padding(
        padding: EdgeInsets.all(0),
        child: Card(
          child: Padding(
            padding: EdgeInsets.only(left: 8),
            child: Column(
              children: <Widget>[
                SizedBox(
                  height: 16,
                ),
                Row(
                  children: <Widget>[
                    Padding(
                      padding: EdgeInsets.only(left: 150),
                      child: Align(
                        alignment: Alignment.center,
                        child: Text(
                          "Issuesid : " + news.issuesid.toString(),
                          style: TextStyle(fontWeight: FontWeight.w500),
                        ),
                      ),
                    ),
                    Padding(
                      padding: EdgeInsets.only(left: 50),
                      child: RaisedButton(
                        color: Colors.green,
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) =>
                                    Checkin(news.issuesid.toString())),
                          ).then((value) {
                            setState(() {
                              _handleRefresh();
                            });
                          });
                        },
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(30.0),
                        ),
                        child: Text(
                          "CheckIn",
                          style: TextStyle(color: Colors.white70),
                        ),
                      ),
                    ),
                  ],
                ),
                SizedBox(
                  height: 16,
                ),
                Divider(
                  thickness: 1,
                  color: Colors.grey,
                  endIndent: 10,
                ),
                Row(
                  children: <Widget>[
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "No.Room = " + news.noRoom,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "TYPE = " + news.typename,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.stretch,
                        children: [
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "STATUS = " + news.issName,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "Assignment = " + news.assignment,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
                SizedBox(
                  height: 16,
                ),
                Divider(
                  thickness: 1,
                  color: Colors.grey,
                  endIndent: 10,
                ),
                Row(
                  children: <Widget>[
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: <Widget>[
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "SUBJECT = " + news.subject.toString(),
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "DESCRIPTION = " + news.description,
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
                Divider(
                  thickness: 1,
                  color: Colors.grey,
                  endIndent: 10,
                ),
                Row(
                  children: <Widget>[
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "Createby = " + news.createby,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "UpdateBy = " + news.updatedby,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.stretch,
                        children: <Widget>[
                          Text(
                            "Created = " +
                                formatter.formatInBuddhistCalendarThai(
                                    news.createdAt),
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "Updated = " +
                                formatter.formatInBuddhistCalendarThai(
                                    news.updatedAt),
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
                Center(
                  child: Container(
                    width: MediaQuery.of(context).size.width,
                    height: 50.0,
                    margin: EdgeInsets.all(10),
                    padding: EdgeInsets.symmetric(horizontal: 80.0),
                    child: RaisedButton(
                      color: Colors.pink,
                      onPressed: () {
                        setState(() {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) =>
                                    Comment(news.issuesid.toString())),
                          ).then((value) {
                            setState(() {
                              _handleRefresh();

                            });
                          });
                        });
                      },
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(30.0),
                      ),
                      child: Text(
                        "Comment (" + count + ")",
                        style: TextStyle(color: Colors.white70),
                      ),
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      );
}

//Todo Closed
class IssuesClosedDetail extends StatefulWidget {
  Closed_s closed;

  IssuesClosedDetail(this.closed);

  @override
  _IssuesClosedDetailState createState() => _IssuesClosedDetailState(closed);
}

class _IssuesClosedDetailState extends State<IssuesClosedDetail> {
  Closed_s closed;

  _IssuesClosedDetailState(this.closed);

  String statuscheckin;
  String count;
  DateTime time = DateTime.now();
  bool _disposed = false;
  bool _loading;
  var formatter = DateFormat.yMd().add_jm();

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    _loading = true;
    Timer(Duration(seconds: 1), () {
      if (!_disposed)
        setState(() {
          time = time.add(Duration(seconds: -1));
        });
    });
    getCommentCount();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    _disposed = true;
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text("Detail"),
        backgroundColor: Colors.white,
        shape: ContinuousRectangleBorder(
          borderRadius: const BorderRadius.only(
            bottomLeft: Radius.circular(60.0),
            bottomRight: Radius.circular(60.0),
          ),
        ),
      ),
      body: (_loading
          ? new Center(
          child: new CircularProgressIndicator(
            backgroundColor: Colors.white70,
          ))
          : ListView(
        children: <Widget>[
          _titleSection(context),
        ],
      )),
      backgroundColor: kPrimaryColor,
    );
  }

  getCommentCount() async {
    Map data = {'issuesid': closed.issuesid.toString()};
    var jsonData = null;
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    var response = await http.post(
        '${ApiUrl}'+"/api/issues-getcountComment",
        body: data);
    if (response.statusCode == 200) {
      jsonData = json.decode(response.body);
      if (jsonData != null) {
        setState(() {
          sharedPreferences.setString('count', jsonData['count'].toString());
          count = sharedPreferences.getString('count');
          _loading = false;
        });
      }
    } else {
      print(response.body);
    }
  }

  Future<Null> _handleRefresh() async {
    Completer<Null> completer = new Completer<Null>();

    new Future.delayed(new Duration(milliseconds: 3)).then((_) {
      completer.complete();
      setState(() {
        Timer(Duration(seconds: 1), () {
          if (!_disposed)
            setState(() {
              time = time.add(Duration(seconds: -1));
            });
        });
        _loading = true;
        Jsondata.getClosed().then((closeds) {
          setState(() {
            _loading = false;
          });
        });
      });
    });

    return null;
  }

  Widget _titleSection(context) => Padding(
        padding: EdgeInsets.all(0),
        child: Card(
          child: Padding(
            padding: EdgeInsets.only(left: 8),
            child: Column(
              children: <Widget>[
                SizedBox(
                  height: 16,
                ),
                Row(
                  children: <Widget>[
                    Padding(
                      padding: EdgeInsets.only(left: 150),
                      child: Align(
                        alignment: Alignment.center,
                        child: Text(
                          "Issuesid : " + closed.issuesid.toString(),
                          style: TextStyle(fontWeight: FontWeight.w500),
                        ),
                      ),
                    ),
                    Padding(
                      padding: EdgeInsets.only(left: 50),
                      child: RaisedButton(
                        color: Colors.green,
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) =>
                                    Checkin(closed.issuesid.toString())),
                          ).then((value) {
                            setState(() {
                              _handleRefresh();

                            });
                          });
                        },
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(30.0),
                        ),
                        child: Text(
                          "CheckIn",
                          style: TextStyle(color: Colors.white70),
                        ),
                      ),
                    ),
                  ],
                ),
                SizedBox(
                  height: 16,
                ),
                Divider(
                  thickness: 1,
                  color: Colors.grey,
                  endIndent: 10,
                ),
                Row(
                  children: <Widget>[
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "No.Room = " + closed.noRoom,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "TYPE = " + closed.typename,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                        ],
                      ),
                    ),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.stretch,
                        children: [
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "STATUS = " + closed.issName,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "Assignment = " + closed.assignment,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
                SizedBox(
                  height: 16,
                ),
                Divider(
                  thickness: 1,
                  color: Colors.grey,
                  endIndent: 10,
                ),
                Row(
                  children: <Widget>[
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: <Widget>[
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "SUBJECT = " + closed.subject.toString(),
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "DESCRIPTION = " + closed.description,
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
                Divider(
                  thickness: 1,
                  color: Colors.grey,
                  endIndent: 10,
                ),
                Row(
                  children: <Widget>[
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "Createby = " + closed.createby,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "UpdateBy = " + closed.updatedby,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.stretch,
                        children: <Widget>[
                          Text(
                            "Created = " +
                                formatter.formatInBuddhistCalendarThai(
                                    closed.createdAt),
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "Updated = " +
                                formatter.formatInBuddhistCalendarThai(
                                    closed.updatedAt),
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
                Center(
                  child: Container(
                    width: MediaQuery.of(context).size.width,
                    height: 50.0,
                    margin: EdgeInsets.all(10),
                    padding: EdgeInsets.symmetric(horizontal: 80.0),
                    child: RaisedButton(
                      color: Colors.pink,
                      onPressed: () {
                        setState(() {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) =>
                                    Comment(closed.issuesid.toString())),
                          ).then((value) {
                            setState(() {
                              _handleRefresh();
                              getCommentCount();
                            });
                          });
                        });
                      },
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(30.0),
                      ),
                      child: Text(
                        "Comment (" + count + ")",
                        style: TextStyle(color: Colors.white70),
                      ),
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      );
}

//Todo new
class IssuesMyjobDetail extends StatefulWidget {
  Myjob myjob;

  IssuesMyjobDetail(this.myjob);

  @override
  _IssuesMyjobDetailState createState() => _IssuesMyjobDetailState(myjob);
}

class _IssuesMyjobDetailState extends State<IssuesNewDetail> {
  Myjob myjob;

  _IssuesMyjobDetailState(this.myjob);

  String statuscheckin;
  String count;
  DateTime time = DateTime.now();
  bool _disposed = false;
  bool _loading;
  var formatter = DateFormat.yMd().add_jm();

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    _loading = true;
    Timer(Duration(seconds: 1), () {
      if (!_disposed)
        setState(() {
          time = time.add(Duration(seconds: -1));
        });
    });
    getCommentCount();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    _disposed = true;
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text(_loading ? 'Loading...' : "Detail"),
        backgroundColor: Colors.white,
        shape: ContinuousRectangleBorder(
          borderRadius: const BorderRadius.only(
            bottomLeft: Radius.circular(60.0),
            bottomRight: Radius.circular(60.0),
          ),
        ),
      ),
      body: (_loading
          ? new Center(
              child: new CircularProgressIndicator(
              backgroundColor: Colors.white70,
            ))
          : ListView(children: <Widget>[
              _titleSection(context),
            ])),
      backgroundColor: kPrimaryColor,
    );
  }

  getCommentCount() async {
    Map data = {'issuesid': myjob.issuesid.toString()};
    var jsonData = null;
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    var response = await http.post(
        '${ApiUrl}'+"/api/issues-getcountComment",
        body: data);
    if (response.statusCode == 200) {
      jsonData = json.decode(response.body);
      if (jsonData != null) {
        setState(() {
          _loading = false;
          sharedPreferences.setString('count', jsonData['count'].toString());
          count = sharedPreferences.getString('count');
        });
      }
    } else {
      print(response.body);
    }
  }

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
        Jsondata.getMyjob().then((news) {
          setState(() {
            _loading = false;
          });
        });
      });
    });

    return null;
  }

  Widget _titleSection(context) => Padding(
        padding: EdgeInsets.all(0),
        child: Card(
          child: Padding(
            padding: EdgeInsets.only(left: 8),
            child: Column(
              children: <Widget>[
                SizedBox(
                  height: 16,
                ),
                Row(
                  children: <Widget>[
                    Padding(
                      padding: EdgeInsets.only(left: 150),
                      child: Align(
                        alignment: Alignment.center,
                        child: Text(
                          "Issuesid : " + myjob.issuesid.toString(),
                          style: TextStyle(fontWeight: FontWeight.w500),
                        ),
                      ),
                    ),
                    Padding(
                      padding: EdgeInsets.only(left: 50),
                      child: RaisedButton(
                        color: Colors.green,
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) =>
                                    Checkin(myjob.issuesid.toString())),
                          ).then((value) {
                            setState(() {
                              _handleRefresh();

                            });
                          });
                        },
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(30.0),
                        ),
                        child: Text(
                          "CheckIn",
                          style: TextStyle(color: Colors.white70),
                        ),
                      ),
                    ),
                  ],
                ),
                SizedBox(
                  height: 16,
                ),
                Divider(
                  thickness: 1,
                  color: Colors.grey,
                  endIndent: 10,
                ),
                Row(
                  children: <Widget>[
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "No.Room = " + myjob.noRoom,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "TYPE = " + myjob.typename,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.stretch,
                        children: [
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "STATUS = " + myjob.issName,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "Assignment = " + myjob.assignment,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
                SizedBox(
                  height: 16,
                ),
                Divider(
                  thickness: 1,
                  color: Colors.grey,
                  endIndent: 10,
                ),
                Row(
                  children: <Widget>[
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: <Widget>[
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "SUBJECT = " + myjob.subject.toString(),
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "DESCRIPTION = " + myjob.description,
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
                Row(
                  children: <Widget>[
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "Createby = " + myjob.createby,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "UpdateBy = " + myjob.updatedby,
                            style: TextStyle(
                                fontWeight: FontWeight.w500, fontSize: 14),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.stretch,
                        children: <Widget>[
                          Text(
                            "Created = " +
                                formatter.formatInBuddhistCalendarThai(
                                    myjob.createdAt),
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                          Text(
                            "Updated = " +
                                formatter.formatInBuddhistCalendarThai(
                                    myjob.updatedAt),
                            style: TextStyle(
                              fontWeight: FontWeight.w500,
                              fontSize: 14,
                            ),
                          ),
                          SizedBox(
                            height: 16,
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
                Center(
                  child: Container(
                    width: MediaQuery.of(context).size.width,
                    height: 50.0,
                    margin: EdgeInsets.all(10),
                    padding: EdgeInsets.symmetric(horizontal: 80.0),
                    child: RaisedButton(
                      color: Colors.pink,
                      onPressed: () {
                        setState(() {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) =>
                                    Comment(myjob.issuesid.toString())),
                          ).then((value) {
                            setState(() {
                              _handleRefresh();
                              getCommentCount();
                            });
                          });
                        });
                      },
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(30.0),
                      ),
                      child: Text(
                        "Comment (" + count + ")",
                        style: TextStyle(color: Colors.white70),
                      ),
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      );
}
