import 'package:flutter/material.dart';
import 'package:hotelhelpdesk/Screens/detail.dart';
import 'package:transparent_image/transparent_image.dart';
import 'package:hotelhelpdesk/Other/constants.dart';

class News extends StatefulWidget {
  @override
  _NewsState createState() => _NewsState();
}

class _NewsState extends State<News> {
  @override
  Widget build(BuildContext context) {
    return SafeArea(
      child: Scaffold(
        appBar: AppBar(
          title: Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Text(
                "Home",
              )
            ],
          ),
          backgroundColor: Colors.white,
        ),
        backgroundColor: kPrimaryColor,
        body: GestureDetector(
          child: Padding(
            padding: const EdgeInsets.all(10.0),
            child: Stack(
              children: <Widget>[
                Container(
                  height: 120,
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(24),
                    color: Colors.white,
                    boxShadow: [
                      BoxShadow(
                        color: Colors.black.withOpacity(0.2),
                        spreadRadius: 5,
                        blurRadius: 7,
                        offset: Offset(0, 3), // changes position of shadow
                      ),
                    ],
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
                        flex: 8,
                        child: Padding(
                          padding: EdgeInsets.only(left: 10),
                          child: Column(
                            mainAxisSize: MainAxisSize.min,
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: <Widget>[
                              Text(
                                "เลขห้อง 704",
                                overflow: TextOverflow.ellipsis,
                                style: TextStyle(
                                    color: Colors.black87,
                                    fontWeight: FontWeight.w700,
                                    fontSize: 17),
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              Text(
                                "อุปกรณ์ที่ชำรุด เตียง ",
                                style: TextStyle(
                                    color: Colors.black45,
                                    fontWeight: FontWeight.w700,
                                    fontSize: 17),
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
                              "Status : News",
                              style: TextStyle(
                                  color: Colors.black87,
                                  fontWeight: FontWeight.w700,
                                  fontSize: 17),
                            ),
                            SizedBox(
                              height: 16,
                            ),
                            Text(
                              "Createat : 21/12/2020",
                              style: TextStyle(
                                  color: Colors.black45,
                                  fontWeight: FontWeight.w700,
                                  fontSize: 17),
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
          onTap: () {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => NewsDetail()),
            );
          },
        ),
      ),
    );
  }

  Widget _logo() => Padding(
        padding: EdgeInsets.only(top: 10),
        child: FadeInImage.memoryNetwork(
            placeholder: kTransparentImage,
            width: MediaQuery.of(context).size.width * 0.8,
            image:
                "https://lh3.googleusercontent.com/proxy/655Uyo1QEUIC4pMiTxratrOddB7f4Mmmtw3Rs7nn93jixlzxbapGlUgzCtK4viBT_Qw9IddixkzU-W6xVfUqPgYL80NpDA9Q12DItYVfDsa4HCXazIt4SFXbxe-SaYXDwHDbx1lE"),
      );
}
