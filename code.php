<?php

// index.php
$context = Timber::get_context();
$context['posts'] = new Timber\PostQuery();

$args = [
    'posts_per_page' => 3,
    'category_name' => 'news'
];

$context['news'] = Timber::get_posts( $args );
Timber::render( 'views/templates/index.twig', $context );

// entry.twig
<article class="article large m-b-80">
  <div class="cover m-b-40">
    <a href="{{ post.link }}"><img src="{{ post.thumbnail }}" alt="{{ post.title }}" /></a>
    <a href="{{ post.link }}" class="readmore">Czytaj dalej</a>
  </div>
  <div class="article article-meta">
    <p class="meta m-b-30 middle-size light">
      <a href="{{ post.category.link }}" class="light">{{ post.category.name }}</a><span class="display-inline-block m-r-20 m-l-20">/</span>{{ post.date("d F Y") }}
    </p>
    <h2 class="title m-b-0"><a href="{{ post.link }}" class="black">{{ post.title }}</a></h2>
  </div>
</article>

//archive.php
<?php
$context = Timber::get_context();
$context['term'] = new TimberTerm();

$context['posts'] = new Timber\PostQuery();

Timber::render( [ 'views/templates/archive-'. $context['term']->slug. '.twig', 'views/templates/archive.twig'], $context );
?>

// archive.twig 
{% extends "/layouts/base.twig" %}

{% block content %}
  <div class="grid-container">
    <div class="grid-x grid-padding-x">
      <div class="cell">
        {% block archive_header %}
        <p class="middle-size light m-b-10"><span>Zobacz wszystkie teksty z kategorii:</span></p>
        <h1 class="font-55 m-b-80">{{ term.name }}</h1>
        {% endblock %}
      </div>
    </div>
  </div>

  {% block main_content %}
  <div class="grid-container">
    <div class="grid-x grid-padding-x">
      {% for post in posts %}
      <div class="cell medium-4 small-12">
        {% include 'views/parts/entry.twig' %}
      </div>
      {% endfor %}
    </div>
  </div>
  {% endblock %}

  {% include 'views/parts/pagination.twig' %}

{% endblock %}

// pagination
{# Paginacja #}
<div class="grid-container wp-pagination m-b-80 p-t-20">
<div class="grid-x grid-padding-x">
    <div class="cell small-12 medium-6 text-center medium-text-left">
    {% if posts.pagination.prev %}
        <a href="{{posts.pagination.prev.link}}" class="prev p-t-20 {{posts.pagination.prev.link|length ? '' : 'invisible'}}"><span class="faicon"><i class="fal fa-long-arrow-left"></i></span> Poprzednia strona</a>
    {% endif %}
    </div>

    <div class="cell small-12 medium-6 text-center medium-text-right">
    {% if posts.pagination.next %}
        <a href="{{posts.pagination.next.link}}" class="next p-t-20 {{posts.pagination.next.link|length ? '' : 'invisible'}}">Następna strona<span class="faicon"><i class="fal fa-long-arrow-right"></i></span></a>
    {% endif %}
    </div>
</div>
</div>


// single
{% extends "/layouts/base.twig" %}

{% block content %}
<article class="article m-b-80">

  <div class="grid-container">
    <div class="grid-x grid-padding-x">
      <div class="cell">
        <div class="article article-meta">
          <p class="meta m-b-30 middle-size light">
            {{ breadcrumbs }}
          </p>
          <p class="meta m-b-30 middle-size light">
            {{ post.category.name }}<span class="display-inline-block m-r-20 m-l-20">/</span>{{ post.date("d F Y") }}
          </p>
          <h1 class="font-55 m-b-80">{{ post.title }}</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="grid-container collapse half-fluid m-b-80">
    <div class="grid-x grid-padding-x">
      <div class="cell">
        <img src="{{ post.thumbnail |  letterbox(1450, 600, '#ccc') }}" alt="{{ post.title }}" />
      </div>
    </div>
  </div>

  <div class="grid-container m-b-50 text-content">
    <div class="grid-x grid-padding-x align-center">
      <div class="cell large-7 medium-10 small-11">
        <p>{{ post.komentarze }}</p>

        {{ post.komentarze_tpl }}

        {{ post.content }}
      </div>
    </div>
  </div>

  {# pod postem #}
  <div class="grid-container m-b-80 after-post">
    <div class="grid-x grid-padding-x align-center">
      <div class="cell large-7 medium-10 small-12">
        {% if post.terms( 'post_tag' ) %}
        <div class="tags light middle-size m-b-40">
          Tagi:
          {% for tag in post.terms( 'post_tag' ) | slice(0,5) %}
            <a href="{{ tag.link }}" class="light">{{ tag.name }}</a>{{ loop.last ? '' : ', ' }}
          {% endfor %}
        </div>
        {% endif %}

        <a href="" class="share-post"><i class="fab fa-facebook-f"></i></a>
        <a href="" class="share-post"><i class="fab fa-twitter"></i></a>

      </div>
    </div>
  </div>

</article>


{% endblock %}


// menu - setup.php
register_nav_menus( array(
    'main_menu' => 'Main menu',
    'footer_menu' => 'Footer menu',
) );

// header.twig
{% for item in main_menu.get_items %}
    {% if item.has_child_class %}
        <li class="has-children {{ item.classes|join(' ') }}" tab-index="0"><a target="{{ item.target }}" href="{{item.link}}">{{item.name}}</a>
        <ul>
            {% for child in item.get_children %}
            <li class="{{ item.classes|join(' ') }}"><a target="{{ child.target }}" href="{{child.link}}">{{child.name}}</a></li>
            {% endfor %}
        </ul>
        </li>
    {% else %}
        <li class="{{ item.classes|join(' ') }}"><a target="{{ item.target }}" href="{{item.link}}">{{item.name}}</a></li>
    {% endif %}
{% endfor %}

// footer.twig
{% for item in footer_menu.get_items %}
    <li class="{{ item.classes|join(' ') }}" tab-index="0">
        <a target="{{ item.target }}" href="{{item.link}}">{{item.name}}</a>
    </li>
    {% endfor %}
</ul>


// entry + resize
<article class="article large m-b-80">
  <div class="cover m-b-40">
    <a href="{{ post.link }}"><img src="{{ post.thumbnail | resize( 610, 420, 'center' ) }}" alt="{{ post.title }}" /></a>
    <a href="{{ post.link }}" class="readmore">Czytaj dalej</a>
  </div>
  <div class="article article-meta">
    <p class="meta m-b-30 middle-size light">
      <a href="{{ post.category.link }}" class="light">{{ post.category.name }}</a><span class="display-inline-block m-r-20 m-l-20">/</span>{{ post.date("d F Y") }}
    </p>
    <h2 class="title m-b-0"><a href="{{ post.link }}" class="black">{{ post.title }}</a></h2>
  </div>
</article>

{{ Image( post.thumbnail ).src('large') }}
{{ Image( post.thumbnail ).src | resize( 400,400 ) }}
{{ Image( post.thumbnail ).src | tojpg | resize( 400,400 ) }}
{{ Image( post.thumbnail ).src | letterbox(600, 600, '#FFFFFF') }}

// filters.php
add_filter('timber/twig', 'add_to_twig');

function add_to_twig($twig) {
    /* this is where you can add your own functions to twig */
    $twig->addExtension( new Twig_Extension_StringLoader() );
    $twig->addFilter( new Twig_SimpleFilter( 'fb_share_url', 'fb_share_url' ) );
    $twig->addFilter( new Twig_SimpleFilter( 'tt_share_url', 'tt_share_url' ) );
    return $twig;
}

/**
 * Share url to FB
 *
 * @param string $url
 * @return string
 */
function fb_share_url( $url ) {
    $url = 'https://www.facebook.com/sharer.php?u='. urlencode( $url );
    return $url;
}

/**
 * Share url to TT
 *
 * @param string $url
 * @param string $title
 * @return string
 */
function tt_share_url( $url, $title='' ) {
    $url = 'https://twitter.com/intent/tweet?url='. urlencode( $url );

    if ( $title != '' ) {
        $url .= '&text='.urlencode( $title );
    }
    return $url;
}

// single.twig
<a href="{{ post.link | fb_share_url }}" class="share-post"><i class="fab fa-facebook-f"></i></a>
<a href="{{ post.link | tt_share_url( post.title ) }}" class="share-post"><i class="fab fa-twitter"></i></a>

//Class-posts.php
<?php
Class WCPL_Post extends TimberPost {
    var $_komentarze;

    public function komentarze() {
        if( ! isset( $this->_komentarze ) ) {
            $this->_komentarze = get_comments_number( $this->ID );
        }

        if( $this->_komentarze == 0 ) {
            $ret = 'Brak komentarzy';
        } else {
            $ret = 'Komentarze: '. $this->_komentarze;
        }

        return $ret;
    }

    public function komentarze_tpl() {
        if( ! isset( $this->_komentarze ) ) {
            $this->_komentarze = get_comments_number( $this->ID );
        }

        if( $this->_komentarze == 0 ) {
            $context['komentarze_info'] = 'Brak komentarzy';
            $context['komentarze_class'] = 'red';
        } else {
            $context['komentarze_info'] = 'Komentarze: '. $this->_komentarze;
            $context['komentarze_class'] = 'green';
        }

        return Timber::compile( 'views/parts/common-komentarze.twig', $context );
    }
}

// page.php
<?php
$context = Timber::get_context();
$context['post'] = Timber::get_post();

$args = [
    'posts_per_page' => 2,
    'post__in' => get_field( 'wybrane_wpisy' ),
];
$context['wybrane'] = Timber::get_posts( $args );

Timber::render( ['views/templates/page.twig'], $context );

?>

// page.twig
{% if wybrane %}
<div class="grid-container">
<div class="grid-x grid-padding-x">
    {% for post in wybrane %}
    <div class="cell medium-6 small-12">
    {% include 'views/parts/entry.twig' %}
    </div>
    {% endfor %}
</div>
</div>
{% endif %}