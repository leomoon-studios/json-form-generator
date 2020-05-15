# JSON Form Generator
LeoMoon JFG generates HTML form tags from JSON file/input. JFG supports all types and attributes of form tags.

## Why JSON?
Companies change their software every couple of years. If they have too many pages and forms, they need to redesign the whole thing again. But when you are using JSON format, you don't have to worry about redesigning everything. You just write a new JSON render engine in a new programming language or framework. Here is an example:

## Documentation
### Usage
```php
  require_once('form.class.php');
  $form = new Form(['file'=>'./example_form.json']);
  $form->show();
```
### Sample JSON file
```json
{
    "name": "formName",
    "title": "Registration form",
    "description": "simple JFG example.",
    "method": "post",
    "action": "http://leomoon.com",
    "properties": {
      "firstName": {
        "type": "input",
        "title": "First name",
        "name":"firstName",
        "value": "test",
        "required": true,
        "onChange":"console.log(this.value)"
      },
      "lastName": {
        "type": "input",
        "title": "Last name",
        "name":"lastName",
        "disabled": true
      },
      "age": {
        "type": "number",
        "title": "Age",
        "name":"age"
      },
      "bio": {
        "type": "input",
        "title": "Bio",
        "name":"bio",
        "placeholder":"Biography"
      },
      "password": {
        "type": "password",
        "title": "Password",
        "name":"password",
        "min": 3
      },
      "language": {
        "type": "select",
        "title": "Language",
        "name":"lang",
        "options":
            {"en":"English",
            "fa":"Farsi",
            "de":"German"
            }
      },
      "submit": {
        "type": "submit",
        "title": "Save Form",
        "name":"submit"
      }
    }
  }
  ```