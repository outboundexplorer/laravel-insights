###General notes

* When we are working inside the class of one namespace, if we want to refer to a class from another namespace, we must use a preceding backslash **\MyNamespace** in order to reference back to the global namespace. 

* Alternatively, we can declare which classes we want to use above the class declaration using **use MyNamespace** and do not need to include the preceding backslash.

* When we have conflicting class names, we can use aliases to work around this.

* It is probably better practice to declare all used classes with a **use MyNamespace** declaration rather than using preceding backslashes within the class as this is less likely to lead to programming errors.

___

###Working with Namespaces in Laravel

* **routes.php** is in the Illuminate namespace therefore any classes that are used from different namespaces must be declared in full

* Any new namespaces that we create must be declared in the **composer.json** file using **psr-o** autoloading entry. (We must then run **composer dump** from the command line in order to include the new class autoloader in composer)




