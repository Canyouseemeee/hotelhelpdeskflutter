// To parse this JSON data, do
//
//     final checkin = checkinFromJson(jsonString);

import 'dart:convert';

List<Checkins> checkinFromJson(String str) => List<Checkins>.from(json.decode(str).map((x) => Checkins.fromJson(x)));

String checkinToJson(List<Checkins> data) => json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class Checkins {
  Checkins({
    this.checkinid,
    this.issuesid,
    this.status,
    this.detail,
    this.createby,
    this.createdAt,
    this.updatedAt,
  });

  int checkinid;
  int issuesid;
  int status;
  String detail;
  String createby;
  DateTime createdAt;
  DateTime updatedAt;

  factory Checkins.fromJson(Map<String, dynamic> json) => Checkins(
    checkinid: json["Checkinid"],
    issuesid: json["Issuesid"],
    status: json["Status"],
    detail: json["Detail"],
    createby: json["Createby"],
    createdAt: DateTime.parse(json["created_at"]),
    updatedAt: DateTime.parse(json["updated_at"]),
  );

  Map<String, dynamic> toJson() => {
    "Checkinid": checkinid,
    "Issuesid": issuesid,
    "Status": status,
    "Detail": detail,
    "Createby": createby,
    "created_at": createdAt.toIso8601String(),
    "updated_at": updatedAt.toIso8601String(),
  };
}
