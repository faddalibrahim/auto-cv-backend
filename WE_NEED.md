// retrieve last id in the database

```sql


/* in the student class */
public static getLastId(){
    SELECT student_id FROM student ORDER BY student_id DESC LIMIT 1;
}

self::getLastDatabaseId()


/* in the adming class */
public static getLastId(){
    SELECT admin_id FROM admin ORDER BY admin_id DESC LIMIT 1;
}

self::getLastDatabaseId()

```

```php
// constants.req.php
define("EXPLODE_AT", "D");
define("STUDENT_ID_PREFIX", "AD");
define("ADMIN_ID_PREFIX", "SD");

```

// explode to get the id

```php

/* student and admin IDs are of the form
*
* admin : AD1, AD2....AD100
* student: SD1, SD2....SD100
*
* we get the number by splitting the ID at "D"
*
*/

require "constants.req.php";

$previous_id_number = explode(EXPLODE_AT,$previous_id);
$new_id_number = $previous_id_number + 1;

$new_student_id = STUDENT_ID_PREFIX . strval($new_id_number);
$new_admin_id = ADMIN_ID_PREFIX . strval($new_id_number);

```
