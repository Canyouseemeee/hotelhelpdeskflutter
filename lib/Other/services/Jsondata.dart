import 'package:hotelhelpdesk/Models/Closed.dart';
import 'package:hotelhelpdesk/Models/Myjob.dart';
import 'package:hotelhelpdesk/Models/New.dart';
import 'package:hotelhelpdesk/Models/Progress.dart';
import 'package:hotelhelpdesk/Other/constants.dart';
import 'package:hotelhelpdesk/Other/services/Constants.dart';
import 'package:http/http.dart' as http;


class Jsondata {

  static Future<List<Closed_s>> getClosed() async {
    const String url = '${ApiUrl}'+"/api/issues-closed";
    try {
      final response = await http.get(url);
      if (response.statusCode == 200) {
        if (response.body.isNotEmpty) {
          final List<Closed_s> closeds = ClosedFromJson(response.body);
          return closeds;
        }
      } else {
        return List<Closed_s>();
      }
    } catch (e) {
      return List<Closed_s>();
    }
  }

  static Future<List<Progress_s>> getProgress() async {
    const String url = '${ApiUrl}'+"/api/issues-progress";
    try {
      final response = await http.get(url);
      if (response.statusCode == 200) {
        if (response.body.isNotEmpty) {
          final List<Progress_s> progress = ProgressFromJson(response.body);
          return progress;
        }
      } else {
        return List<Progress_s>();
      }
    } catch (e) {
      return List<Progress_s>();
    }
  }

  static Future<List<New>> getNew() async {
    const String url = '${ApiUrl}'+"/api/issues-new";
    try {
      final response = await http.get(url);
      if (response.statusCode == 200) {
        if (response.body.isNotEmpty) {
          final List<New> news = NewFromJson(response.body);
          return news;
        }

      } else {
        return List<New>();
      }
    } catch (e) {
      return List<New>();
    }
  }

  static Future<List<Myjob>> getMyjob() async {
    const String url = '${ApiUrl}'+"/api/issues-getissuesuser";
    try {
      final response = await http.get(url);
      if (response.statusCode == 200) {
        if (response.body.isNotEmpty) {
          final List<Myjob> myjobs = MyjobFromJson(response.body);
          return myjobs;
        }

      } else {
        return List<Myjob>();
      }
    } catch (e) {
      return List<Myjob>();
    }
  }



}
