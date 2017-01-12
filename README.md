# ChangeString.php

* Testing with:
~~~~
$ php ChangeString.php "string"
~~~~

# ClearPar.php

* Testing with:
~~~~
$ php ClearPar.php "(()()()()(()))))())((())"
~~~~

# CompleteRange.php

* Testing with:
~~~~
$ php CompleteRange.php
~~~~
NOTE: The example values are inside the code

# Application Web

* Start the API service:
~~~~
$ cd application
$ php -S 0.0.0.0:8080 -t public public/index.php
~~~~

* Url for testing 
~~~~
http://localhost:8080/api/v1/employees
~~~~

* Url for XML testing
~~~~
http://localhost:8080/api/v1/searchs/salary?min=100&max=1,291.57
~~~~