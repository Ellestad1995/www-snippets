# Client side technology



## HTML-Meta

```HTML
<meta charset="UTF-8" >
<link rel="stylesheet" media="screen" href="css/styles.css"> // egne kataloger for css og javascript etc. media->screen betyr strip css ved utskrift
```



## HTML

Reference: [Mozilla HTML5 reference](https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/HTML5)

```html
<div></div>
<span></span>
<form></form>
<input required/>
<input pattern="regexp"/>
```



## CSS

Reference: [mozilla css reference](https://developer.mozilla.org/en-US/docs/Web/CSS/Reference)

```css
.classname {
    
}
.classname tagname {
    
}
#div {
    
}

//Hensyn til nettlesere

::-webkit-*
::-moz-*
::-ms-*

*:focus{} //all focused elements

.classname li:first-child, .classname li:last-child {
    
}

{
    background: url(data:image/gif;base64;)
}

.classname::before{
    content: "\escapeunicode"
}

```



## Cookies

* Små mengder informasjon som sendes fra server->klient og klient->server

```PHP
$_COOKIE['name'] //Access to cookies
isset($COOKIE['name']) //If server received named cookie
setcookie('name',1, time()+60*60*24) 
```



* name - 

* value

* expires - unix timestamp

  ----

* path - If set to *'/'*, the cookie will be available within the entire `domain`. If set to *'/foo/'*, the cookie will only be available within the */foo/* directory and all sub-directories such as */foo/bar/* of `domain`. The default value is the current directory that the cookie is being set in.

* domain - 

* secure - true/false - true= only when https is possible on client side. On server programmer must fin d out if https ([$_SERVER["HTTPS"\]](http://php.net/manual/en/reserved.variables.server.php)))

* httponly

* options

Slett en cookie ved å `setcookie` til tom verdi og gyldig i bakover tid. Da vil nettleser slette cookie.

`setcookie` må kjøres før noe html returners. Server kan buffre før scriptet kjøres ferdig.

## Session



`session_start()`

 PHPSESSID

Samme session id er samme bruker. 

`$_SESSION`

* Lagre kun brukerdata og enkle datastrukturer

**Fjerne**

* session_destroy
* session_unset



## Testing

