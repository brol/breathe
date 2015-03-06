Préambule
=========

Les plugins suivants sont requis : [menu](http://aiguebrun.adjaya.info/post/20090202/Telegarger-le-Plugin-Menu-pour-Dotclear2-Download/), [List Images from entries](http://lab.dotclear.org/wiki/plugin/listImages/) et [templateWidget](http://lab.dotclear.org/wiki/plugin/templateWidget/).

A noter que les gravatars qui s'affichent dans les commentaires ne nécessitent pas l'installation d'un plugin (code inséré directement dans _public.php).

Dans le contexte billet seul, le service [addthis](http://www.addthis.com/) a été inclus pour faciliter le partage (fichier user_share.html).

De plus, il est impératif de renseigner la description des catégories sous peine d'afficher un rectangle bleu si la catégorie ne possède aucune sous-catégorie.
Non seulement c'est une bonne pratique et fera du bien à votre référencement, mais en plus ça m'arrange ;-)

Enfin, ce thème n'étant pas compatible avec Internet Explorer 6, les utilisateurs de ce truc vieillissant et dépassé verront un horrible bandeau au début du blog les invitant à mettre à jour leur navigateur ou à en installer un autre.

Le thème
--------

'''Titre du blog, un simple lien ou une image cliquable'''[[BR]]
Le fichier _top.html est prévu pour afficher un simple lien vers votre blog :

```html
{{{
<h1><span><a href="{{tpl:BlogURL}}">{{tpl:BlogName encode_html="1"}}</a></span></h1>
}}}
```

ou une image liée (/corpoweeeb/img/logo.png) :

```html
{{{
<h1><a href="{{tpl:BlogURL}}"><img src="{{tpl:BlogThemeURL}}/img/logo.png" alt="{{tpl:BlogName encode_html="1"}}" /></a></h1>
}}}
```

Choisir l'un ou l'autre en commentant/décommentant le code (le code pour l'image est, par défaut, commenté). Les codes de la css seront évidemment à adapter en fonction de la hauteur de votre image (attribut height de #title dans style.css). Concernant la description du blog, si vous affichez une image en titre, il sera nécessaire d'adapter le code css afin de repositionner l'affichage du texte de la description du blog.

La page d'accueil
-----------------
Afin de ne pas répéter le slide présent sur la page d'accueil lors de la navigation dans les éventuelles pages suivantes, le code du slide est entouré de la balise
```html
{{{
<tpl:SysIf current_mode="default">...</tpl:SysIf>
}}}
```

Le thème propose plusieurs types de navigation
----------------------------------------------
 * un menu reposant sur le plugin menu (menuH.css est calibré pour afficher le niveau 2 des sous-catégories sous forme horizontale ; menuV.css l'est pour plusieurs niveaux de sous-catégories sous forme verticale)
 * un menu fixe situé en bas à droite de la page (inclus dans _footer.html)
 * un dock au-dessus du footer listant sous forme d'images les 9 derniers billets (bug sous ie8, les titres des billets ne s'affichent pas au-dessus des images lors de leur survol)
 * un menu dans le footer ne listant que les catégories de premier niveau et affichant au survol les 80 premiers caractères de leur description
 * deux widgets dans la sidebar nécessitant le plugin templateWidget :[[BR]]
- '''catfav''' affiche les 4 derniers billets d'une catégorie préférée (première image du billet, titre du billet limité aux 30 premiers caractères, le nombre de commentaires si permis et le fil atom de la catégorie). Il faut bien entendu renseigner le nom urlisé de la catégorie et l'url du flux atom dans le fichier catfav.widget.html pour que ça fonctionne.[[BR]]
- '''selection''' affiche les 5 derniers billets sélectionnés (première image du billet, titre du billet limité aux 30 premiers caractères et le nombre de commentaires si permis). Fichier selection.widget.html

'''4 types de slides et 5 types d'affichage'''[[BR]]
Par défaut, les billets utilisés sont ceux sélectionnés.[[BR]]

'''Affichage sans texte'''[[BR]]
 * _slide-1.html fait appel au fichier slide650.css (images de 650px de large X 300px de haut) et est positionné sous la barre de menu, la liste des billets sera en-dessous et la sidebar à leur droite, tabulation sous forme de chiffres. Le code, à insérer après la la balise {{{<div id="main">}}}, est le suivant :[[BR]]
{{{
  <div class="slide clearfix">
    {{tpl:include src="_slide-1.html"}}
  </div> <!-- End slide 1 -->
}}}
 * _slide-1.html fait appel au fichier slide960.css (images de 960px de large X 300px de haut) et est positionné sous la barre de menu, la liste des billets et la sidebar seront en-dessous, tabulation sous forme de chiffres. Le code, à insérer avant la la balise {{{<div id="main">}}}, est le suivant :[[BR]]
{{{
  <div class="slide clearfix">
    {{tpl:include src="_slide-1.html"}}
  </div> <!-- End slide 1 -->
}}}

'''Affichage avec texte'''[[BR]]
 * _slide-2.html fait appel au slide650V.css (images de 650px de large X 300px de haut) et est positionné sous la barre de menu, la liste des billets sera en-dessous et la sidebar à leur droite, tabulation sous forme de vignettes, titre du billet associé et les 80 premiers caractères du billet étant positionnés sous les vignettes. Le code, à insérer après la la balise {{{<div id="main">}}}, est le suivant :[[BR]]
{{{
  <div class="slide clearfix">
    {{tpl:include src="_slide-2.html"}}
  </div> <!-- End slide 2 -->
}}}

 * _slide-3.html fait appel au slide960T.css (images de 960px de large X 300px de haut) et est positionné sous la barre de menu, la liste des billets et la sidebar seront en-dessous, tabulation sous forme de chiffres, titre du billet associé et les 300 premiers caractères du billet étant positionnés au-dessus des tabulations à droite de l'image. Le code, à insérer avant la la balise {{{<div id="main">}}}, est le suivant :[[BR]]
{{{
  <div class="slide clearfix">
    {{tpl:include src="_slide-3.html"}}
  </div> <!-- End slide 3 -->
}}}

 * _slide-4.html fait appel au slideS3.css (images de 650px de large X 300px de haut) et est positionné sous la barre de menu, la liste des billets sera en-dessous et la sidebar à leur droite, pas de tabulation, titre du billet associé et les 300 premiers caractères du billet étant positionné sur un fond translucide avec effet de slide. Le code, à insérer après la la balise {{{<div id="main">}}}, est le suivant :[[BR]]
{{{
  <div class="slide clearfix">
    {{tpl:include src="_slide-4.html"}}
  </div> <!-- End slide 4 -->
}}}

Ce dernier slide a un bug : si vous voulez afficher les 4 derniers billets, il faut mettre lastn="5" et non lastn="4" dans la balise <tpl:Entries>, pas trop compris d'où ça pouvait venir... Je cherche ;-(


Par défaut, le slide s'appuie sur les 4 derniers billets sélectionnés. Vous pouvez cependant l'utiliser pour afficher les billets d'une catégorie ou d'un tag.

Pour une catégorie précise on mettra à la place de <tpl:Entries selected="1" lastn="4"> ceci <tpl:Entries category="Url-de-votre-categorie" lastn="4">[[BR]]
Pour un tag précis on mettra à la place de <tpl:Entries selected="1" lastn="4"> ceci <tpl:Entries tag="Nom du tag" lastn="4">

'''Contraintes''' : vous ne pouvez pas panacher plusieurs types de slides dans un même blog.[[BR]]
Vous ne pouvez pas mettre plus d'un slide par fichier html dans le même contexte.[[BR]]
Par contre, vous pouvez effectuer une sélection sur les catégories afin d'afficher un slide 650 sur la catégorie dont l'url est ''Machin'' et un autre slide 650 dont l'url est ''Truc''. Il vous faudra bien entendu dupliquer et renommer le fichier _slide-1.html.[[BR]]
Exemple avec le fichier category.html :

{{{
  <tpl:CategoryIf url="Machin">
  <div class="slide clearfix">
  {{tpl:include src="_slide-1.html"}}
  </div><!-- End slide machin -->
  </tpl:CategoryIf>

  <tpl:CategoryIf url="Truc">
  <div class="slide clearfix">
  {{tpl:include src="_slide-2.html"}}
  </div><!-- End slide truc-->
  </tpl:CategoryIf>
}}}


 * la navigation dans le contexte billet seul se fait dans la catégorie et non sur la totalité du blog.

'''Trois types d'affichage des listes de billets'''
 * affichage conventionnel : les billets se positionnent les uns au-dessous des autres,

{{{
<div class="post">
  <div class="post-meta clearfix">
    <h2 class="post-title left"><a href="{{tpl:EntryURL}}"
    title="{{tpl:EntryTitle encode_html="1"}}">{{tpl:EntryTitle encode_html="1"}}</a></h2>
    <p class="post-info right">
      <span class="infopost"><span>{{tpl:lang By}} {{tpl:EntryAuthorLink}}</span>
			{{tpl:EntryDate}}</span>
    </p>
  </div><!-- End post-meta -->

  <div class="post-box">
    <div class="post-content">

      <div class="post-intro">

      <!-- # --BEHAVIOR-- publicEntryBeforeContent -->
     {{tpl:SysBehavior behavior="publicEntryBeforeContent"}}

        <div class="entryimages">
       {{tpl:EntryImages size="o" html_tag="div" link="none" legend="none" length="1"}}
        </div>

        <!-- # Entry with an excerpt -->
        <tpl:EntryIf extended="1">
        <p>{{tpl:EntryExcerpt encode_html="1" remove_html="1" cut_string="350"}} [...]</p>
        </tpl:EntryIf>

        <!-- # Entry without excerpt -->
        <tpl:EntryIf extended="0">
        <p>{{tpl:EntryContent encode_html="1" remove_html="1" cut_string="350"}} [...]</p>
        </tpl:EntryIf>

        <!-- # --BEHAVIOR-- publicEntryAfterContent -->
       {{tpl:SysBehavior behavior="publicEntryAfterContent"}}

			</div><!-- End post-intro -->
		</div><!-- End post-content -->

		<div class="post-footer clearfix">
			<div class="continue-reading">
				<a href="{{tpl:EntryURL}}"
        title="{{tpl:lang Continue reading}} {{tpl:EntryTitle encode_html="1"}}">{{tpl:lang Continue reading}}</a>
			</div>

			<div class="category-menu">
        <tpl:EntryIf has_category="1">
          <div class="clearfix">
            <a href="{{tpl:EntryCategoryURL}}" title="{{tpl:CategoryDescription cut_string="80" remove_html="1"}}...">
            {{tpl:EntryCategory encode_html="1"}}
            </a>
          </div>
        </tpl:EntryIf>
      </div><!-- End category -->
    </div><!-- End post-footer -->
  </div><!-- End post-box -->
</div><!-- End post -->
}}}

 * affichage single : les billets sont par couple de deux,

{{{
<div class="post single">
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
}}}

 * affichage small : sous forme de liste très simplifiée (par exemple dans le fichier archive_month.html).

{{{
  <tpl:Entries>
  <div class="post">
    <div class="post-meta clearfix">
      <h2 class="post-title-small left"><a href="{{tpl:EntryURL}}"
      title="{{tpl:EntryTitle encode_html="1"}}">{{tpl:EntryTitle encode_html="1"}}</a></h2>
      <p class="post-info right">
        <span class="infopost"><span>{{tpl:lang By}} {{tpl:EntryAuthorLink}}</span>
        {{tpl:EntryDate}}</span>
      </p>
    </div><!-- End post-meta -->
  </div><!-- End post -->
}}}

'''Cas particulier du widget texte'''[[BR]]
La sidebar a un fonctionnement normal excepté pour les widgets texte.[[BR]]
Ceux-ci n'ont pas, par défaut, de titre (<h2>) ni de contour...[[BR]]
Pour obtenir un widget texte avec titre et/ou contour il est nécessaire de :[[BR]]
- laisser vide le champ du titre du widget,[[BR]]
- englober votre code dans une <div class="wtext">...</div> dans le champ texte du widget, par exemple :

{{{
<div class="wtext">
<h2>Le titre de votre widget</h2>
<p>Votre texte</p>
<img src="lien/vers/votre/image" alt="" />
</div>
}}}

'''Footer'''[[BR]]
Sont intégrés divers tpl dans le footer (_footer.html) :[[BR]]
- {{tpl:BlogEditor}} : champ Nom de l'éditeur du blog, vous pouvez l'englober par du html (exemple : <a href="http://votreurl.ext">nom de votre blog</a>),[[BR]]
- {{tpl:BlogCopyrightNotice}} : champ Note de copyright, idem,[[BR]]
- {{tpl:lang Designed by}} <a href="http://www.weeeb.fr">Weeeb</a> : mes références d'auteur du thème, merci de le laisser,[[BR]]
- <a href="/pages/Mentions-legales">{{tpl:lang Legal mentions}}</a> : lien vers une page de Mentions légales que vous aurez à créer, ou alors vous supprimez le lien...

=== Astuces ===

 * '''Positionnement du moteur de recherche dans la barre de menu'''
Dans post.html, déplacer le
{{{<div id="recherche">...</div>}}} après le {{{<tpl:SysIf has_tag="MenuFreshy">{{tpl:MenuFreshy level="0"}}</tpl:SysIf>}}}.[[BR]]
Dans style.css, modifier les styles de #recherche et #search comme indiqué dans le fichier.

 * '''Réduire la navigation dans le contexte billet seul à une catégorie particulière'''
Installer le plugin [http://lab.dotclear.org/wiki/plugin/myPostCategoryIf/ myPostCategoryIf].[[BR]]
Dans post.html, remplacer le code {{{<div id="navlinks">...</div>}}} par celui-ci en le renseignant avec le nom urlisé de votre catégorie :

{{{
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
}}}

 * '''Afficher les billets de toutes les catégories selon l'affichage single et une catégorie particulière selon l'affichage conventionnel'''
Ajoutez après la balise <tpl:Entries>, la condition excluant la catégorie à afficher selon le mode conventionnel. Vous devez obtenir ceci :

{{{
<!-- # -- liste des billets single -->
<tpl:Entries>
  <tpl:CategoryIf url="!Url-de-ma-categorie-particuliere">
    <div class="post single">
}}}

Le ! devant l'URL permet d'inverser le sens du test.

Puis on ferme le bloc par ceci :

{{{
<tpl:EntryIf odd="0"> <div style="clear:left;"> </div> </tpl:EntryIf>
<!-- # -- End liste des billets single -->
</tpl:CategoryIf>
}}}

A la suite, on ajoute le code pour l'affichage des billets de la catégorie particulière selon le mode d'affichage conventionnel, en prenant soin de renseigner son url. Vous devez obtenir ceci :

{{{
      <!-- # -- liste des billets conventionnel -->
      <tpl:CategoryIf url="Url-de-ma-categorie-particuliere">
        <div class="post">
          <div class="post-meta clearfix">
          <h2 class="post-title left"><a href="{{tpl:EntryURL}}"
          title="{{tpl:EntryTitle encode_html="1"}}">{{tpl:EntryTitle encode_html="1"}}</a></h2>
          <p class="post-info right">
          <span class="infopost"><span>{{tpl:lang By}} {{tpl:EntryAuthorLink}}</span>
          {{tpl:EntryDate}}</span>
          </p>
          </div><!-- End post-meta -->

          <div class="post-box">
            <div class="post-content">
            <div class="post-intro">

            <!-- # --BEHAVIOR-- publicEntryBeforeContent -->
            {{tpl:SysBehavior behavior="publicEntryBeforeContent"}}

            <div class="entryimages">
            {{tpl:EntryImages size="o" html_tag="div" link="none" legend="none" length="1"}}
            </div>

            <!-- # Entry with an excerpt -->
            <tpl:EntryIf extended="1">
            <p>{{tpl:EntryExcerpt encode_html="1" remove_html="1" cut_string="350"}} [...]</p>
            </tpl:EntryIf>

            <!-- # Entry without excerpt -->
            <tpl:EntryIf extended="0">
            <p>{{tpl:EntryContent encode_html="1" remove_html="1" cut_string="350"}} [...]</p>
            </tpl:EntryIf>

            <!-- # --BEHAVIOR-- publicEntryAfterContent -->
            {{tpl:SysBehavior behavior="publicEntryAfterContent"}}

            </div><!-- End post-intro -->
            </div><!-- End post-content -->

            <div class="post-footer clearfix">
              <div class="continue-reading">
              <a href="{{tpl:EntryURL}}"
              title="{{tpl:lang Continue reading}} {{tpl:EntryTitle encode_html="1"}}">{{tpl:lang Continue reading}}</a>
              </div>
            </div><!-- End post-footer -->
          </div><!-- End post-box -->
        </div><!-- End post -->
      </tpl:CategoryIf>
      <!-- # -- End liste des billets conventionnel -->
}}}

 * '''Afficher les sous-catégories sous forme de tableau d'images'''
Dans category.html, remplacer le code :

{{{
<!-- # Subcategories and Entries -->
<div class="cat-subcat">
<tpl:CategoryFirstChildren>
  <tpl:CategoriesHeader>
  <div id="subcategories">
    <h3>{{tpl:lang Subcategories}}</h3>
      <ul>
  </tpl:CategoriesHeader>
        <li><a href="{{tpl:CategoryURL}}">{{tpl:CategoryTitle encode_html="1"}}</a></li>
  <tpl:CategoriesFooter>
      </ul>
  </div>
  </tpl:CategoriesFooter>
</tpl:CategoryFirstChildren>
</div><!-- End subcat -->
}}}

par ceci :

{{{
<!-- # Subcategories and Entries -->
<div class="cat-subcat">
<tpl:CategoryFirstChildren>
  <tpl:CategoriesHeader>
  <div id="subcategories" class="clearfix">
    <h3>{{tpl:lang Subcategories}}</h3>
  </tpl:CategoriesHeader>
    <div class="subcat">
      <h4><a href="{{tpl:CategoryURL}}">{{tpl:CategoryTitle encode_html="1"}}</a></h4>
      <tpl:Entries ignore_pagination="1" no_content="1" lastn="1" order="asc" >
      {{tpl:CategoryDescription}}
    </div>
      </tpl:Entries>
  <tpl:CategoriesFooter>
  </div>
  </tpl:CategoriesFooter>
</tpl:CategoryFirstChildren>
</div><!-- End subcat -->
<!-- End subcategories -->
}}}

et décommenter dans style.css la partie "sous-cat en tableau".

Dans la description des sous-catégories, il vous faudra alors coder ainsi :

{{{
<p><img title="Title de l'image" alt="Texte alternatif de l'image" src="/chemin/vers/image.ext" /></p>
<p class="catdesctxt">Description de la sous-catégorie</p>
}}}
