// To parse this JSON data, do
//
//     final new = newFromJson(jsonString);

import 'dart:convert';

List<New> NewFromJson(String str) => List<New>.from(json.decode(str).map((x) => New.fromJson(x)));

String NewToJson(List<New> data) => json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class New {
  New({
    this.issuesid,
    this.noRoom,
    this.issName,
    this.typename,
    this.assignment,
    this.subject,
    this.description,
    this.createby,
    this.updatedby,
    this.createdAt,
    this.updatedAt,
  });

  int issuesid;
  String noRoom;
  String issName;
  String typename;
  String assignment;
  String subject;
  String description;
  String createby;
  String updatedby;
  DateTime createdAt;
  DateTime updatedAt;

  factory New.fromJson(Map<String, dynamic> json) => New(
    issuesid: json["Issuesid"],
    noRoom: json["NoRoom"],
    issName: json["ISSName"],
    typename: json["Typename"],
    assignment: json["Assignment"],
    subject: json["Subject"],
    description: json["Description"],
    createby: json["Createby"],
    updatedby: json["Updatedby"],
    createdAt: DateTime.parse(json["created_at"]),
    updatedAt: DateTime.parse(json["updated_at"]),
  );

  Map<String, dynamic> toJson() => {
    "Issuesid": issuesid,
    "NoRoom": noRoom,
    "ISSName": issName,
    "Typename": typename,
    "Assignment": assignment,
    "Subject": subject,
    "Description": description,
    "Createby": createby,
    "Updatedby": updatedby,
    "created_at": createdAt.toIso8601String(),
    "updated_at": updatedAt.toIso8601String(),
  };
}
