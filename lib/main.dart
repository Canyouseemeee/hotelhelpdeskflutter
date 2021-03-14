import 'package:flutter/material.dart';
import 'package:hotelhelpdesk/Other/constants.dart';
import 'package:hotelhelpdesk/Screens/Login/login_screen.dart';
import 'package:flutter/services.dart';
import 'package:intl/intl.dart';
import 'package:intl/date_symbol_data_local.dart';
import 'package:flutter/cupertino.dart';



void main() {
  //todo datethai
  Intl.defaultLocale = 'th';
  initializeDateFormatting();
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {

    SystemChrome.setPreferredOrientations([
      DeviceOrientation.portraitUp,
      DeviceOrientation.portraitDown
    ]);

    SystemChrome.setSystemUIOverlayStyle(SystemUiOverlayStyle(
      statusBarColor: Colors.redAccent,
      statusBarIconBrightness: Brightness.dark,
      systemNavigationBarColor: Colors.redAccent,
      systemNavigationBarIconBrightness: Brightness.light
    ));

    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Hotel HelpDesk',
      theme: ThemeData(
        primaryColor: kPrimaryColor,
        scaffoldBackgroundColor: Colors.white,
      ),
      home: LoginScreen(),
    );
  }
}
