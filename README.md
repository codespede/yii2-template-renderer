Template Renderer for Yii 2
===========================

Facilitates rendering data in any custom format/structure with just a parent-view, child-view and DataProvider(Supports pagination, sorting, filtering and all other operations supported by DataProvider). Though this extension is mainly intended for RESTful APIs built in Yii 2, it can be used anywhere in the application as explained below.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require codespede/yii2-template-renderer "*"
```

or add

```json
"codespede/yii2-template-renderer": "*"
```

to the `require` section of your composer.json.

How to use
----------

One can use this by simply returning the TemplateRenderer object in any action as shown in the below code:

public function actionRender(){
    $dataProvider = new ActiveDataProvider(['query' => Model::find()->where($condition)])
    return new \yii\rest\TemplateRenderer([
            'dataProvider' => $dataProvider,
            'parentView' => '/path/to/parent-view', //path to the parent or wrapper view file
            'itemView' => '/path/to/item-view', //path to the item view file
        ]);
}

Use Cases
---------
- Suppose you want to deliver the data in CSV format like below:
```
title,image,content
ABC,abc.jpg,Content of ABC
MNO,mno.jpg,Content of MNO
XYZ,xyz.jpg,Content of XYZ
```
 - Suppose you have to render the API response in a specific format like below:
```
-begin-
--title=ABC
--image=abc.jpg
--content=Content of ABC
---
--title=MNO
--image=mno.jpg
--content=Content of MNO
---
--title=XYZ
--image=xyz.jpg
--content=Content of XYZ
-end-
```
 - Or in any situation where the you have to deliver custom formatted data through the API.

Advantages
---------
- The data can be paginated, sorted and filtered just as how it can be done with a GridView or ListView. You can pass the pagination, sort and filter parameters in the URL and the content rendered will be according to the provided parameters.
- Easy to navigate through paginated content by utilizing Pagination Headers in the response.
