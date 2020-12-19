import 'package:flutter/material.dart';
import 'package:hotelhelpdesk/Other/constants.dart';
import 'dart:io';

import 'package:image_picker/image_picker.dart';

class Comments extends StatefulWidget {
  @override
  _CommentsState createState() => _CommentsState();
}

class _CommentsState extends State<Comments> {

  bool _loading;
  ScrollController _scrollController = new ScrollController();
  DateTime time = DateTime.now();
  bool _disposed = false;
  TextEditingController commentController = new TextEditingController();
  File imageFile;
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  String _commenttext = "";

  @override
  void initState() {
    // TODO: implement initState
    _loading = false;
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Align(
          alignment: Alignment.center,
          child: Padding(
              padding: EdgeInsets.only(right: 10),
              child: Text(_loading ? 'Loading...' : "Comment")),
        ),
        actions: [
          IconButton(
            icon: Icon(
              Icons.add,
              color: Colors.black,
            ),
            onPressed: () {
              _showDialog();
            },
          ),
        ],
        backgroundColor: Colors.white,
      ),
      body: (_loading
          ? new Center(
          child: new CircularProgressIndicator(
            backgroundColor: Colors.white70,
          ))
          : _showJsondata()),
      backgroundColor: kPrimaryColor,
    );
  }

  _showDialog() async {
    await showDialog<String>(
      context: context,
      barrierDismissible: false,
      child: new AlertDialog(
        title: Text('Comment'),
        content: Form(
          key: _formKey,
          autovalidate: true,
          child: Container(
            width: double.maxFinite,
            child: SingleChildScrollView(
              child: Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Stack(
                    children: <Widget>[
                      new ListView(
                        shrinkWrap: true,
                        children: [
                          TextFormField(
                            keyboardType: TextInputType.multiline,
                            maxLines: null,
                            controller: commentController,
                            decoration: InputDecoration(
                                hintText: "Comment", icon: Icon(Icons.comment)),
                            onSaved: (value)  => _commenttext = value,
                            validator: (value){
                              if (value.length < 4) {
                                return "Enter Comment min 4 character";
                              }
                              if (value.isEmpty) {
                                return "Enter Comment";
                              }else{
                                return null;
                              }
                            },
                          ),
                          _decideImageView(),
                        ],
                      ),
                    ],
                  ),
                ],
              ),
            ),
          ),
        ),
        actions: <Widget>[
          new FlatButton(
            child: new Text('SAVE'),
            onPressed: () {
              setState(() {
                if(_formKey.currentState.validate()) {
                  _formKey.currentState.save();
                  // postcomment(news.toString(), imageFile);
                  // print(news);
                  // print(imageFile.path.split('/').last);
                  Navigator.pop(context);
                  // showAlertupdatesuccess();
                }
              });
            },
          ),
          new FlatButton(
            child: new Text('Chosse Image'),
            onPressed: () {
              _showChoiceDialog(context);
            },
          ),
          new FlatButton(
            child: new Text('Close'),
            onPressed: () {
              Navigator.pop(context);
            },
          ),
        ],
      ),
    );
  }

  Future<void> _showChoiceDialog(BuildContext context) {
    return showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: Text("Make a Choice"),
            content: SingleChildScrollView(
              child: ListBody(
                children: <Widget>[
                  GestureDetector(
                    child: Text("Gallary"),
                    onTap: () {
                      _openGallry(context);
                    },
                  ),
                  Padding(padding: EdgeInsets.all(8.0)),
                  GestureDetector(
                    child: Text("Camera"),
                    onTap: () {
                      _openCamera(context);
                    },
                  ),
                ],
              ),
            ),
          );
        });
  }

  _openGallry(BuildContext context) async {
    var picture = await ImagePicker.pickImage(source: ImageSource.gallery);
    this.setState(() {
      imageFile = picture;
    });
    Navigator.pop(context);
    Navigator.pop(context);
    _showDialog();
  }

  _openCamera(BuildContext context) async {
    var picture = await ImagePicker.pickImage(source: ImageSource.camera);
    this.setState(() {
      imageFile = picture;
    });
    Navigator.pop(context);
    Navigator.pop(context);
    _showDialog();
  }

  Widget _decideImageView() {
    if (imageFile == null) {
      return Padding(
          padding: EdgeInsets.only(top: 100),
          child: Center(child: Text("No Image Selected")));
    } else {
      return Padding(
          padding: EdgeInsets.only(top: 60),
          child: Center(
              child: Image.file(
                imageFile,
                width: 300,
                height: 300,
              )));
    }
  }

  Widget _showJsondata() => new Text("Comments");


}
