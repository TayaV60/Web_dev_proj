# About the view classes and supporting functions

Files in this folder each contain a single view class, with supporting functions below. View classes have a public method for each page. Each of these public methods calls a specific handler method, instantiating a Page with the correct title then displaying the handler method's results.

Supporting functions make use of PHP's "Alternative syntax for control structures" (see
https://www.php.net/manual/en/control-structures.alternative-syntax.php), which allows it to be used as a templating language. This was found to be more readable than using lots of print statements, in part because this allowed HTML syntax higlighting in my code editor. 
