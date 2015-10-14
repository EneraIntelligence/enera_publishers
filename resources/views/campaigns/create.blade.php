@extends('layouts.main')

@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-1">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_menu" data-uk-dropdown>
                                <i class="md-icon material-icons md-icon-light">&#xE5D4;</i>

                                <div class="uk-dropdown uk-dropdown-flip uk-dropdown-small">
                                    <ul class="uk-nav">
                                        <li><a href="#">Action 1</a></li>
                                        <li><a href="#">Action 2</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user_heading_avatar">
                                <img src="assets/img/avatars/avatar_11.png" alt="user avatar"/>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom">
                                    <span class="uk-text-truncate">Crear Nueva Campaña</span>
                                    {{--<span class="sub-heading">Land acquisition specialist</span>--}}
                                </h2>
                                {{--<ul class="user_stats">
                                    <li>
                                        <h4 class="heading_a">2391 <span class="sub-heading">Posts</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a">120 <span class="sub-heading">Photos</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a">284 <span class="sub-heading">Following</span></h4>
                                    </li>
                                </ul>--}}
                            </div>

                        </div>
                        <div class="user_content">
                            <ul id="user_profile_tabs" class="uk-tab"
                                data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}"
                                data-uk-sticky="{ top: 48, media: 960 }">
                                <li class="uk-active"><a href="#">Cuenta</a></li>
                                <li><a href="#">Graficas</a></li>
                                <li><a href="#">Campañas</a></li>
                            </ul>
                            <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                <li>
                                    {{--</p>--}}
                                    <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom"
                                         data-uk-grid-margin>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">Información</h4>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"></span>
                                                        <span class="uk-text-small uk-text-muted">Correo</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">356-649-5349</span>
                                                        <span class="uk-text-small uk-text-muted">Telefono</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">facebook.com/envato</span>
                                                        <span class="uk-text-small uk-text-muted">Facebook</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">twitter.com/envato</span>
                                                        <span class="uk-text-small uk-text-muted">Twitter</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">My groups</h4>
                                            <ul class="md-list">
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Cloud
                                                                Computing</a></span>
                                                        <span class="uk-text-small uk-text-muted">206 Members</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Account Manager
                                                                Group</a></span>
                                                        <span class="uk-text-small uk-text-muted">67 Members</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Digital Marketing</a></span>
                                                        <span class="uk-text-small uk-text-muted">159 Members</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">HR Professionals
                                                                Association - Human Resources</a></span>
                                                        <span class="uk-text-small uk-text-muted">69 Members</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <p>Sección con fotos</p>
                                </li>
                                <li>
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Pariatur ad eius laborum
                                                        architecto id voluptas.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">22 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">20</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">488</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Vel earum maiores suscipit id
                                                        omnis laborum.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">07 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">20</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">809</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Impedit dolore magni aut et
                                                        hic voluptatem.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">10 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">25</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">569</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Explicabo ut rerum dolorem vel
                                                        tenetur.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">02 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">24</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">628</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Aut necessitatibus nihil
                                                        consectetur ipsa.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">21 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">15</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">337</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Molestiae eum quia vero et
                                                        omnis eum asperiores.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">06 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">6</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">884</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Tempore non debitis
                                                        reprehenderit doloribus commodi laboriosam.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">10 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">26</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">498</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Ullam illum est fuga
                                                        voluptatem quibusdam voluptatem sit voluptatem.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">06 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">5</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">779</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Sapiente libero dolorum velit
                                                        consequatur aut.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">14 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">28</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">607</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Repellendus et tenetur est
                                                        ratione sunt.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">29 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">20</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">499</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Et voluptatem sit velit saepe
                                                        exercitationem.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">22 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">13</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">186</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Magni eos suscipit sunt harum
                                                        autem quae unde odit.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">05 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">11</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">542</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Odit ea ea unde
                                                        consequuntur.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">06 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">4</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">762</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Itaque pariatur qui recusandae
                                                        unde tempore vero minus.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">29 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">24</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">134</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Et debitis ea qui
                                                        quas.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">16 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">6</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">675</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Aut est similique ducimus
                                                        earum neque.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">28 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">26</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">169</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Nihil occaecati necessitatibus
                                                        eos libero eveniet inventore voluptas.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">15 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">14</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">718</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Ab quis praesentium cupiditate
                                                        inventore.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">27 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">24</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">718</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Aut occaecati molestiae
                                                        reprehenderit.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">02 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">15</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">754</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Quia sint vero quidem
                                                        architecto.</a></span>

                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">07 Aug 2015</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">19</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">364</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                            {!! Form::open(['url'=>'campaigns']) !!}

                                <div class="md-card-content">
                                    <h3 class="heading_a">
                                        Upload Component
                                        <span class="sub-heading">Allow users to upload files through a file input form element or a placeholder area.</span>
                                    </h3>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <div id="file_upload-drop" class="uk-file-upload">
                                                <p class="uk-text">Drop file to upload</p>
                                                <p class="uk-text-muted uk-text-small uk-margin-small-bottom">or</p>
                                                <a class="uk-form-file md-btn">choose file<input id="file_upload-select" type="file" name="test"></a>
                                            </div>
                                            <div id="file_upload-progressbar" class="uk-progress uk-hidden">
                                                <div class="uk-progress-bar" style="width:0">0%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {!! Form::submit('Crear', ['class' => 'md-btn']) !!}


                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@stop

@section('scripts')

    {!! HTML::script('assets/js/pages/forms_file_upload.min.js') !!}

    <script>


    </script>
@stop