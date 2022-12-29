Breathe est un thème pour Dotclear2.

Depuis "Personnaliser le thème", il est possible de choisir :
* le type de menu à afficher (Simplemenu ou [Menu] (http://plugins.dotaddict.org/dc2/details/menu))
* un environnement coloré prédéfini (si le thème rencontre un minimum de succès, je m'y attèlerai...)
* d'afficher ou non un dock au-dessus du footer qui liste les 25 derniers billets ayant une image (le plugin [listImages] (http://plugins.dotaddict.org/dc2/details/listImages) est requis)
* d'afficher en page d'accueil deux types de slides avec ou sans vignettes (le plugin [listImages] (http://plugins.dotaddict.org/dc2/details/listImages) est requis)
* d'afficher ou non le slide sélectionné dans les pages suivantes de la page d'accueil.

Dans le contexte billet seul, le service [addthis](http://www.addthis.com/) a été inclus pour faciliter le partage (fichier user_share.html) et la navigation se fait dans la catégorie et non sur la totalité du blog.

Ce thème n'est pas compatible avec Internet Explorer 8 et antérieurs.

Le thème
--------

Titre du blog, un simple lien ou une image cliquable.

Le fichier _top.html est prévu pour afficher un simple lien vers votre blog :
```html
<h1><span><a href="{{tpl:BlogURL}}">{{tpl:BlogName encode_html="1"}}</a></span></h1>
```
ou une image liée (/breathe/img/logo.png) :
```html
<h1><a href="{{tpl:BlogURL}}"><img src="{{tpl:BlogThemeURL}}/img/logo.png" alt="{{tpl:BlogName encode_html="1"}}" /></a></h1>
```

Choisir l'un ou l'autre en commentant/décommentant le code (le code pour l'image est, par défaut, commenté). Les codes de la css seront évidemment à adapter en fonction de la hauteur de votre image (attribut height de #title dans style.css). Concernant la description du blog, si vous affichez une image en titre, il sera nécessaire d'adapter le code css afin de repositionner l'affichage du texte de la description du blog.

Le thème propose plusieurs types de navigation
----------------------------------------------
* un menu reposant sur le plugin menu (css/menus/menuH.css est calibré pour afficher le niveau 2 des sous-catégories sous forme horizontale ; css/menus/menuV.css l'est pour plusieurs niveaux de sous-catégories sous forme verticale), ou sur le plugin SimpleMenu (pas de niveau, css/menus/simplemenu.css)
* un menu fixe situé en bas à droite de la page (inclus dans _footer.html)
* un dock au-dessus du footer listant sous forme d'images les 25 derniers billets (css/dock/dock.css)
* un menu dans le footer ne listant que les catégories de premier niveau et affichant au survol les 80 premiers caractères de leur description

Les slides
-----------
Les slides permettent d'afficher des images originales de 650px de large x 300px de haut.
Ils sont positionnés sous la barre de menu, la liste des billets sera en-dessous et la sidebar à leur droite.
Il n'est pas possible d'afficher simultanément les deux slides dans le blog.

Trois choix possibles :
* Pas de slide
* Slide sans vignette (le titre ainsi que le texte (limité au 300 premiers caractères du billet) s'affiche en bas de l'image sur un fond translucide avec un effet de slide).
* Slide avec vignettes (le titre ainsi que le texte (limité au 100 premiers caractères du billet) s'affiche en bas de l'image sur un fond translucide. La tabulation est sous forme de vignettes).

Par défaut, le slide s'appuie sur les 4 derniers billets sélectionnés. Vous pouvez cependant l'utiliser pour afficher les billets d'une catégorie ou d'un tag.
Pour une catégorie précise on mettra à la place de ```<tpl:Entries selected="1" lastn="4" ignore_pagination="1" no_context="1">``` ceci ```<tpl:Entries category="Url-de-votre-categorie" lastn="4" ignore_pagination="1" no_context="1">```.
Et pour un mot-clé précis, cela ```<tpl:Entries tag="Nom du tag" lastn="4" ignore_pagination="1" no_context="1">```.

Rappel des codes des slides :

slide1.html :

```html
<div id="slider" class="slide1">
  <ul id="sliderContent">
  <tpl:Entries selected="1" lastn="4" ignore_pagination="1" no_context="1">
    <li class="sliderImage">
    {{tpl:EntryImages size="o" html_tag="div" link="entry" length="1"}}
    <span class="bottom"><strong><a href="{{tpl:EntryURL}}">{{tpl:EntryTitle encode_html="1"}}</a></strong>
    <br />
    <!-- # Entry with an excerpt -->
    <tpl:EntryIf extended="1">
    {{tpl:EntryExcerpt encode_html="1" remove_html="1" cut_string="300"}}...
    </tpl:EntryIf>

    <!-- # Entry without excerpt -->
    <tpl:EntryIf extended="0">
    {{tpl:EntryContent encode_html="1" remove_html="1" cut_string="300"}}...
    </tpl:EntryIf>
    </span>
    </li>
  </tpl:Entries>
  <div class="clear sliderImage"></div>
</ul>

<script type="text/javascript">
    $(document).ready(function() {
        $('#slider').s3Slider({
            timeOut: 5000
        });
    });
</script>
</div>
```

slide2.html :

```html
<div class="slide2">
<div class="slide clearfix">
<div class="slide-content">
  <div class="slide-content-post">
  <tpl:Entries selected="1" lastn="4" ignore_pagination="1" no_context="1">
    <div class="post">
      <div class="image">
        {{tpl:EntryImages size="o" html_tag="div" link="entry" length="1"}}
      </div>

      <div class="texte">
        <h2 class="post-title"><a href="{{tpl:EntryURL}}">{{tpl:EntryTitle encode_html="1"}}</a></h2>

        <!-- # Entry with an excerpt -->
        <tpl:EntryIf extended="1">
        <div class="post-content">{{tpl:EntryExcerpt encode_html="1" remove_html="1" cut_string="100"}}...</div>
        </tpl:EntryIf>

        <!-- # Entry without excerpt -->
        <tpl:EntryIf extended="0">
          <div class="post-content">{{tpl:EntryContent encode_html="1" remove_html="1" cut_string="100"}}...</div>
        </tpl:EntryIf>
      </div>

    </div>
  </tpl:Entries>
</div> <!-- End #slide-content-post -->

<div class="slidetabs">
<tpl:Entries selected="1" lastn="4" ignore_pagination="1" no_context="1">
  <div class="vignette">
    {{tpl:EntryImages size="m" html_tag="div" link="entry" length="1"}}
  </div>
</tpl:Entries>
</div>

<script type="text/javascript">
$(".slide2 .slide-content .slidetabs").slidetabs(".slide2 .slide-content .post", {

effect: 'fade',
fadeOutSpeed: "normal",
rotate: true

}).slideshow({ autoplay: true, interval: 4000 });

</script>
</div>
</div>
</div><!-- End #slide-content -->
```

Deux types d'affichage des listes de billets
---------------------------------------------
* affichage single : les billets sont par couple de deux,

```html
<div id="p{{tpl:EntryID}}" class="post single {{tpl:EntryIfOdd}} {{tpl:EntryIfFirst}}" lang="{{tpl:EntryLang}}" role="article">
  <div class="post-meta clearfix">
    <h2 class="post-title left"><a href="{{tpl:EntryURL}}" title="{{tpl:EntryTitle encode_html="1"}}">{{tpl:EntryTitle encode_html="1"}}</a></h2>
  </div><!-- End post-meta -->

  <div class="post-box">
    <div class="post-content">
      <div class="post-intro-moy">

      <!-- # --BEHAVIOR-- publicEntryBeforeContent -->
      {{tpl:SysBehavior behavior="publicEntryBeforeContent"}}

      <div class="entryimages">
      {{tpl:EntryImages size="o" html_tag="div" link="none" legend="none" length="1"}}
      </div>

      <!-- # Entry with an excerpt -->
      <tpl:EntryIf extended="1">
      <p class="moy">{{tpl:EntryExcerpt encode_html="1" remove_html="1" cut_string="300"}} [...]</p>
      </tpl:EntryIf>

      <!-- # Entry without excerpt -->
      <tpl:EntryIf extended="0">
      <p class="moy">{{tpl:EntryContent encode_html="1" remove_html="1" cut_string="300"}} [...]</p>
      </tpl:EntryIf>

      <!-- # --BEHAVIOR-- publicEntryAfterContent -->
      {{tpl:SysBehavior behavior="publicEntryAfterContent"}}

    </div><!-- End post-intro -->
  </div><!-- End post-content -->

  <div class="post-footer clearfix">
    <div class="continue-reading">
      <a href="{{tpl:EntryURL}}" title="{{tpl:lang Continue reading}} {{tpl:EntryTitle encode_html="1"}}">{{tpl:lang Continue reading}}</a>
    </div>
  </div><!-- End post-footer -->
</div><!-- End post-box -->
</div><!-- End post -->

<tpl:EntryIf odd="0"> <div style="clear:left;"> </div> </tpl:EntryIf>
```

* affichage small : sous forme de liste très simplifiée (par exemple dans le fichier archive_month.html).

```html
<tpl:Entries>
  <div class="post">
    <div id="p{{tpl:EntryID}}" class="post-meta clearfix">
      <h2 class="post-title-small left" lang="{{tpl:EntryLang}}"><a
      href="{{tpl:EntryURL}}" title="{{tpl:lang Read}} {{tpl:EntryTitle encode_html="1"}}">{{tpl:EntryTitle encode_html="1"}}</a></h2>
      <p class="post-info right">
        <span class="infopost"><span>{{tpl:lang By}} {{tpl:EntryAuthorLink}}</span>
        {{tpl:EntryDate}}</span>
      </p>
    </div><!-- End post-meta -->
  </div><!-- End post -->
</tpl:Entries>
```

Widget
------
Le contour de chaque widget peut être restreint à son titre, utiliser la class "noborder" prévue à cet effet.

Footer
------
Sont intégrés divers tpl dans le footer (_footer.html) :

* {{tpl:BlogEditor}} : champ "Nom de l'auteur du blog", vous pouvez l'englober par du html (exemple : ```<a href="http://votreurl.ext">nom de votre blog</a>```) à faire depuis l'administration du blog (paramètres du blog) ,
* {{tpl:BlogCopyrightNotice}} : champ "Note de copyright", idem,
* ```{{tpl:lang Designed by}} <a href="https://github.com/brol/breathe">Pierre Van Glabeke</a>``` : mes références d'auteur du thème, merci de le laisser.
* Une zone "A propos" est réservée dans le footer en regard du menu des catégories. Vous êtes libres du titre et du contenu de cette page du moment que son url est ```/pages/A-propos```.

Astuces
-------
* Réduire la navigation dans le contexte billet seul à une catégorie particulière

Installer le plugin [myPostCategoryIf] (http://plugins.dotaddict.org/dc2/details/myPostCategoryIf).

Dans post.html, remplacer le code ```<div id="navlinks">...</div>``` par celui-ci en le renseignant avec le nom urlisé de votre catégorie :

```html
  <tpl:MyPostCategoryIf url="Votre-categorie">
    <div id="navlinks">
      <p><tpl:EntryPrevious restrict_to_category="1"><a href="{{tpl:EntryURL}}"
      title="{{tpl:EntryTitle encode_html="1"}}" class="prev">&#171; {{tpl:EntryTitle encode_html="1"
      cut_string="70"}}</a></tpl:EntryPrevious>
      <tpl:EntryNext restrict_to_category="1"> <span>-</span> <a href="{{tpl:EntryURL}}"
      title="{{tpl:EntryTitle encode_html="1"}}" class="next">{{tpl:EntryTitle encode_html="1"
      cut_string="70"}} &#187;</a></tpl:EntryNext>
      </p>
    </div>
  </tpl:MyPostCategoryIf>
```

* Afficher les sous-catégories sous forme de tableau d'images

Renommer le fichier category.html en category-normal.html et renommer le fichier category-tab.html en category.html.

Décommenter dans style.css la partie "sous-cat en tableau" (lignes 933 - 962).

Dans la description des sous-catégories, il vous faudra alors coder ainsi :

```html
<p><img title="Title de l'image" alt="Texte alternatif de l'image" src="/chemin/vers/image.ext" /></p>
<p class="catdesctxt">Description de la sous-catégorie</p>
```