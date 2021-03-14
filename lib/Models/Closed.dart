// To parse this JSON data, do
//
//     final closed = closedFromJson(jsonString);

import 'dart:convert';

List<Closed_s> ClosedFromJson(String str) => List<Closed_s>.from(json.decode(str).map((x) => Closed_s.fromJson(x)));

String ClosedToJson(List<Closed_s> data) => json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class Closed_s {
  Closed_s({
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

  factory Closed_s.fromJson(Map<String, dynamic> json) => Closed_s(
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

class EnumValues<T> {
  Map<String, T> map;
  Map<T, String> reverseMap;

  EnumValues(this.map);

  Map<T, String> get reverse {
    if (reverseMap == null) {
      reverseMap = map.map((k, v) => new MapEntry(v, k));
    }
    return reverseMap;
  }
}
