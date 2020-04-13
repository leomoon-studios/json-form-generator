# JSON Form Generator
LeoMoon JFG generate HTML form tags from JSON file/input. JFG supports all types and attributes of form tags.

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
        "required": true
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