AsseticAngularJsBundle
======================
Simple Assetic filter to feed the *$templateCache*.

# Installation
```shell
composer require miguel/assetic-angular-js-bundle
```

## Requirements
Any Symfony2 2.3+ application will do.

# Configuration

Edit your ``config.yml`` and add a section **miguel_assetic_angular_js**:

.. code-block:: yaml
    miguel_assetic_angular_js:
        app_name: app

If you don't do it the default ``app_name`` will be **app**.

# Usage

Just include the Angular templates as any other javascript resource using the javascripts Twig helper and apply the *angular* filter to them.

```twig
{% javascripts filter="angular"
    '@BundleName/Resources/views/aTemplate.html'
    '@BundleName/Resources/views/moarTemplates/*.html'
    'assets/app/tpl/contact/contact.html'
    %}
    <script type="text/javascript" src="{{ asset_url }}"></script>
{% endjavascripts %}
```

The resulting output will be something like this:

```javascript
angular.module("app").run(["$templateCache", function($templateCache) {
  $templateCache.put("BundleName/views/aTemplate.html", "HTML here");
}]);
angular.module("app").run(["$templateCache", function($templateCache) {
  $templateCache.put("BundleName/views/fooTemplate.html", "HTML here");
}]);
angular.module("app").run(["$templateCache", function($templateCache) {
  $templateCache.put("assets/app/tpl/contact/contact.html", "HTML here");
}]);
// ...
```

> If the asset is in a bundle then the **Resources/** part is removed.

Now, to use the template a dependency on the module name must be set and after that the template can be retrieved using the templates URL:

```html
<div data-ng-include="BundleName/views/aTemplate.html"></div>
<div data-ng-include="assets/app/tpl/contact/contact.html"></div>
```

Of course, wherever a template URL can be specified, the above will work as it is in the default AngularJS template cache.

# License
MIT