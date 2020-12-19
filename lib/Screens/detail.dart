import 'package:flutter/material.dart';
import 'package:hotelhelpdesk/Screens/checkin_work.dart';
import 'package:hotelhelpdesk/Screens/comments.dart';

class NewsDetail extends StatefulWidget {
  @override
  _NewsDetailState createState() => _NewsDetailState();
}

class _NewsDetailState extends State<NewsDetail> {
  @override
  Widget build(BuildContext context) {
    return SafeArea(
      child: Scaffold(
        appBar: AppBar(
          title: Text("Detail"),
          backgroundColor: Colors.white,
        ),
        body: Padding(
          padding: EdgeInsets.all(0),
          child: Card(
            color: Color(0xFFE6DFDF),
            child: Padding(
              padding: EdgeInsets.only(left: 8),
              child: Column(
                children: <Widget>[
                  Icon(Icons.home, size: 50,),
                  SizedBox(
                    height: 16,
                  ),
                  Row(
                    children: <Widget>[
                      Padding(
                        padding: EdgeInsets.only(left: 160),
                        child: Align(
                          alignment: Alignment.center,
                          child: Text(
                            "ห้อง 704",
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
                                builder: (context) => Checkin()
                                ),
                            );
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
                        flex: 4,
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            SizedBox(
                              height: 16,
                            ),
                            Text(
                              "อุปกรณ์ที่ชำรุด : เตียง",
                              style: TextStyle(
                                  fontWeight: FontWeight.w500, fontSize: 14),
                            ),
                            SizedBox(
                              height: 16,
                            ),
                            Text(
                              "หมายเหตุ : ขาเตียงหักเนื่อกจากผู้ใช้"
                                  "ขยับเตียงเองโดยไม่แจ้ง",
                              style: TextStyle(
                                  fontWeight: FontWeight.w500, fontSize: 14),
                            ),
                            SizedBox(
                              height: 16,
                            ),
                            Text(
                              "วันเวลาที่มีการแจ้ง : 12/02/2020 11.30น. ",
                              style: TextStyle(
                                  fontWeight: FontWeight.w500, fontSize: 14),
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                  Expanded(
                    child: Container(
                      padding: EdgeInsets.only(top: 300),
                      height: MediaQuery
                          .of(context)
                          .size
                          .height,
                      child: Center(
                        child: Container(
                          width: MediaQuery
                              .of(context)
                              .size
                              .width,
                          height: 50.0,
                          margin: EdgeInsets.all(10),
                          padding: EdgeInsets.symmetric(
                              horizontal: 80.0),
                          child:
                          RaisedButton(
                            color: Colors.pink,
                            onPressed: () {
                              setState(() {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                      builder: (context) =>
                                          Comments()),
                                );
                              });
                            },
                            shape: RoundedRectangleBorder(
                              borderRadius:
                              BorderRadius.circular(30.0),
                            ),
                            child: Text(
                              "Comment ("")",
                              style:
                              TextStyle(color: Colors.white70),
                            ),
                          ),
                        ),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}
