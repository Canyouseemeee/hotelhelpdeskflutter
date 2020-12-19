import 'dart:async';

import 'package:flutter/material.dart';
import 'package:hotelhelpdesk/Other/services/BadgeIcon.dart';
import 'package:hotelhelpdesk/Screens/closed.dart';
import 'package:hotelhelpdesk/Screens/news.dart';
import 'package:hotelhelpdesk/Screens/menu.dart';
import 'package:hotelhelpdesk/Screens/progress.dart';

class HomePage extends StatefulWidget {
  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  int _currentIndex = 0;
  int _tabBarCount = 0;
  List<Widget> pages;
  Widget currantpage;
  int count = 0;
  bool _loading;
  StreamController<int> _countController = StreamController<int>();
  News news = new News();
  Progress progress = new Progress();
  Closed closed = new Closed();
  Menu menu = new Menu();

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    pages = [news,progress, closed, menu];
    currantpage = news;
    // _loading = true;
  }

  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      // appBar: AppBar(
      //   title: Row(
      //    mainAxisAlignment: MainAxisAlignment.center,
      //    children: [
      //      Text(
      //        "WFH",
      //      )
      //    ],
      //  ),
      // ),
      backgroundColor: Colors.blue,
      body: currantpage,
      bottomNavigationBar: RefreshIndicator(
        child: SafeArea(
          child: BottomNavigationBar(
            currentIndex: _currentIndex,
            type: BottomNavigationBarType.fixed,
            // backgroundColor: Color(0xFF34558b),
            selectedItemColor: Color(0xFFFF8C7E),
            items: [
              BottomNavigationBarItem(
                icon: StreamBuilder(
                  initialData: _tabBarCount,
                  stream: _countController.stream,
                  builder: (_, snapshot) => BadgeIcon(
                    icon: Icon(
                      Icons.new_releases_sharp,
                    ),
                    badgeCount: snapshot.data,
                  ),
                ),
                title: const Text("Home"),
              ),
              BottomNavigationBarItem(
                icon: Icon(Icons.history_toggle_off),
                title: Text("Progress"),
              ),
              BottomNavigationBarItem(
                icon: Icon(Icons.close),
                title: Text("Closed"),
              ),
              BottomNavigationBarItem(
                icon: Icon(Icons.menu),
                title: Text("Menu"),
              ),
            ],
            onTap: (index) {
              setState(() {
                _currentIndex = index;
                currantpage = pages[index];
              });
            },
          ),
        ),
        onRefresh: _handleRefresh,
      ),
    );
  }

  Future<Null> _handleRefresh() async {
    Completer<Null> completer = new Completer<Null>();

    new Future.delayed(new Duration(milliseconds: 5)).then((_) {
      completer.complete();
      // setState(() {
      //   _loading = true;
      //   initializing();
      //   Jsondata.getNew().then((_newss) {
      //     setState(() {
      //       _new = _newss;
      //       _loading = false;
      //       if (_new.isNotEmpty) {
      //         return _new.elementAt(0);
      //       }
      //       if (_new.length != 0) {
      //         _tabBarCount = _new.length;
      //         _countController.sink.add(_tabBarCount);
      //       } else {
      //         _tabBarCount = _new.length;
      //         _countController.sink.add(_tabBarCount);
      //       }
      //     });
      //   });
      // });
    });

    return null;
  }
}
