@extends('layouts.main')
@section('head_scripts')
    {!! HTML::style(asset('css/profile.css')) !!}
    <style>
        .md-chart{
            margin: 0 25px;
            padding: 10px 0;
        }

        .md-chart-card
        {
            padding: 20px 0;
        }
    </style>
@endsection

@section('content')

    <div id="page_content">
        <div id="page_content_inner" style="padding-bottom: 25px;">
                <div class="uk-grid uk-grid-small">
                    <div class="uk-width-small-1 uk-width-medium-1-2 md-chart" data-uk-modal="{target:'#modal_overflow'}">
                        <h2>Interacciones Por Genero</h2>
                        <div class="md-card md-card-hover md-chart-card">


                            <div id="chart1"></div>
                        </div>
                    </div>
                    <div class="uk-width-small-1 uk-width-medium-1-2 md-chart" data-uk-modal="{target:'#modal_overflow-2'}">
                        <h2>Historila de Interacciones</h2>
                        <div class="md-card md-card-hover md-chart-card">


                            <div id="chart2"></div>
                        </div>
                    </div>
                    <div class="uk-width-small-1 uk-width-medium-1-2 md-chart" data-uk-modal="{target:'#modal_overflow-3'}">
                        <h2>Visitantes por edades</h2>
                        <div class="md-card md-card-hover md-chart-card">


                            <div id="chart3"></div>
                        </div>
                    </div>
                    <div class="uk-width-small-1 uk-width-medium-1-2 md-chart" data-uk-modal="{target:'#modal_overflow-4'}">
                        <h2>Interacciones por modelos</h2>
                        <div class="md-card md-card-hover md-chart-card">


                            <div id="chart4"></div>
                        </div>
                    </div>
                </div>
        </div>
    </div>


    <div class="uk-width-medium-1-3">
        <p class="uk-text-large">Overflow container in modal</p>
        <button class="md-btn" data-uk-modal="{target:'#modal_overflow'}">Open</button>
        <div id="modal_overflow" class="uk-modal">
            <div class="uk-modal-dialog uk-modal-dialog-large">
                <button type="button" class="uk-modal-close uk-close"></button>
                <h2 class="heading_a">Interacciones Por Genero</h2>
                <p>Quia porro id amet eos optio veniam repudiandae repudiandae quae ipsam dolores dolores eveniet qui et consequatur molestiae minima eos qui et esse optio et iusto vel quis delectus numquam saepe saepe reiciendis cupiditate libero voluptates magnam est facilis.</p>
                <div class="uk-overflow-container">
                    <h2 class="heading_b">Overflow container</h2>
                    <img src="assets/img/gallery/Image06.jpg" alt=""/>
                    <p>Porro vel tenetur explicabo aut doloribus consectetur esse quibusdam facere aliquam ducimus repellendus voluptatem eum veritatis corporis quidem assumenda ut et aut reiciendis maiores mollitia commodi sapiente officia est qui unde placeat iste dolores id non ducimus et rerum quo est magni harum veritatis eaque illo sed consectetur atque ea expedita blanditiis vel fuga explicabo aut quia perferendis quis doloremque consectetur eos ea aut porro debitis reiciendis natus dolorum non fugit expedita ipsam rerum deserunt tenetur impedit veritatis accusamus praesentium voluptatem deserunt dolorem aut aperiam et quidem at earum blanditiis voluptatem eum vero recusandae provident reiciendis quos et eos et facere repellendus deserunt quibusdam dolore facilis nesciunt hic recusandae magnam atque sit sunt nemo odio pariatur non natus minima laborum est qui similique quisquam dolore nostrum sequi assumenda soluta dignissimos quia tenetur aliquam dolore distinctio sint modi non quibusdam est et voluptatem odio esse non similique occaecati qui voluptas qui tempore perferendis quo voluptatum praesentium numquam et earum itaque facilis tempore asperiores molestiae perspiciatis ut officiis omnis non sit et sequi rerum eum accusantium delectus autem rem velit laborum vitae sit iste a nobis eos aliquam enim impedit esse aut voluptatibus distinctio quae et dolorem voluptatem earum praesentium repellendus occaecati qui quasi quia beatae molestiae non cumque tempore maxime dolore est ut sit reprehenderit asperiores ea architecto ipsa beatae aut suscipit dignissimos voluptas quo qui quisquam amet sapiente modi aut sunt neque hic cum quia non sunt sed quas sit eos molestiae incidunt rem illum ut saepe tempora voluptates consequuntur accusantium saepe molestias sed voluptatibus atque aut commodi quod at consequuntur rerum aut autem et perspiciatis magnam facilis dolorum ut sit voluptatem dolor fugiat sit libero suscipit est vero unde ut accusamus et reprehenderit earum ut tempore eum et tenetur corporis quia unde deleniti quia culpa reiciendis dolorem rem aliquam eius minima debitis dolore facilis reiciendis repellendus debitis nobis at sed ducimus omnis.</p>
                    <p>Aut facilis fugit voluptates culpa quia nihil tempora blanditiis iure modi tempora minima sunt explicabo rem voluptatem voluptas optio dolore quibusdam omnis sapiente assumenda illum modi dicta dolor eaque aut sit odit esse nulla qui odit qui deserunt dolor sunt ut quod ullam iste sint delectus voluptas facere optio accusamus rerum dolorem vitae eos ullam ratione qui quas mollitia sint illum omnis atque nisi earum est sint dolores nostrum minima nam est neque quasi exercitationem molestiae saepe est qui autem id impedit ea corporis ipsum aut modi ut ipsam ex iusto odit minus incidunt facere repudiandae odit facere nobis quaerat sed quo ducimus recusandae debitis harum et quas qui quia sunt minima architecto eveniet non repellat ab modi sit deleniti quam itaque eum qui voluptatum ut rerum iusto quidem sequi perspiciatis est aliquid unde ut minus est recusandae explicabo incidunt aut iusto aut est rerum autem odit nemo aliquam et ea natus asperiores necessitatibus ipsum nam ut est laudantium aspernatur ut non dicta optio nam fuga minus quaerat earum iste asperiores rerum quo doloribus quia vero quod labore quod aliquam similique ipsa quos beatae ut asperiores sit voluptatem aperiam quis quis sit nesciunt et quasi quas voluptatum vero occaecati iste ut doloribus aut ea veniam fuga autem doloribus sapiente possimus animi odio illo enim qui minima laborum est sed voluptas praesentium et consequatur facere a repellendus sequi vero et minus sit consequatur excepturi adipisci veritatis itaque laboriosam quo eos cum omnis aut ad quod qui assumenda fuga voluptas ut blanditiis voluptate est vel libero fugit et voluptatem aliquam odio expedita fuga et sunt aut sunt eum voluptas omnis molestiae odio natus saepe suscipit et et assumenda qui distinctio dolores maiores illum tempora animi consectetur fugiat voluptatum eos necessitatibus rerum sapiente dolor impedit nihil ratione vel commodi non.</p>
                    <p>Id tempora corrupti dicta tempora et dolorem excepturi doloribus placeat culpa repudiandae vel ab tempore temporibus accusamus commodi qui exercitationem rerum quibusdam quasi optio autem cum labore voluptatem atque officia dicta voluptas odio esse id deserunt veritatis vitae omnis at explicabo quis dicta dicta atque possimus deleniti vitae ducimus corrupti blanditiis doloremque fugiat eos eveniet repellat in sed amet sed ut veniam iste et quaerat velit qui quo molestias quae ut sequi eum deserunt hic expedita voluptates consequuntur dolor laboriosam iure quis vero deleniti possimus nihil qui voluptate molestiae aperiam excepturi ex tempora doloribus hic nihil atque quo quibusdam laudantium odit quia occaecati eum inventore animi ea ea unde est occaecati natus expedita debitis iste maiores est laboriosam qui dicta voluptatum et est ut ducimus ut aut magni similique iste recusandae iusto vel perferendis facilis voluptatem sapiente delectus in doloremque exercitationem et reprehenderit quos ad omnis delectus incidunt sed blanditiis expedita rerum iusto at tenetur cupiditate ut ut natus distinctio dolore temporibus occaecati repellendus cum dolorum repellat facere quidem quaerat aliquam aspernatur nemo laudantium nisi earum et aut provident ab et voluptatibus consequatur illo illum id nihil magni ut officiis deserunt et nostrum placeat esse fugit provident architecto aliquam consequuntur ad soluta fugit ut iusto quisquam rerum sit voluptates similique voluptatibus et eius dolor sapiente iure doloribus quia vero et consequuntur commodi reiciendis itaque velit error distinctio similique quo similique sed tenetur dolore unde temporibus ab quia eaque natus et quasi pariatur ut enim qui neque et corrupti sed est nemo quibusdam rerum voluptatem repudiandae at velit deserunt qui qui recusandae voluptatem qui earum quae architecto illum necessitatibus adipisci et et voluptas consequatur aut autem quo aut tempore voluptatibus esse reiciendis.</p>
                    <p>Repellat consequuntur est nesciunt explicabo veniam id autem voluptatem corporis veniam ad fugiat provident ipsum explicabo qui dolores perspiciatis enim est omnis dolorem ut minus a blanditiis delectus quia a sed et et accusamus quia qui sunt assumenda ratione et dolorem quis eos id autem impedit dolores provident modi inventore dolor aut mollitia excepturi quis illum mollitia repellat cumque nesciunt consequatur maxime quidem dolores consequatur perspiciatis pariatur debitis nobis officiis sed ea aut voluptatem quidem velit sapiente eligendi dolor porro et aperiam aut iste et vero qui eveniet odio impedit labore vel repellendus quis debitis quia ipsum id officia quia aliquid totam consequatur debitis et facere quibusdam laboriosam exercitationem asperiores minima velit aut qui porro necessitatibus id sint incidunt sit voluptatem id id pariatur qui provident sed vitae nesciunt vero nobis in ipsam ut eum eos accusantium enim iste assumenda nesciunt veritatis unde alias voluptates qui doloremque sed modi et vero omnis qui ipsa porro ut deleniti molestiae dolorem sint quam et nemo nemo optio sapiente quo similique voluptas repudiandae aut quidem est cum ut ut adipisci unde ut id et nostrum labore atque ab autem esse est commodi commodi itaque ipsum totam est excepturi sint aut ipsa repudiandae consequatur qui error assumenda molestias cum cupiditate perspiciatis quisquam eum ratione doloribus aperiam iusto laboriosam quia vitae explicabo non natus quia nihil et quaerat qui placeat nihil sequi omnis architecto et rerum animi ut in rerum debitis reiciendis soluta dicta enim rerum saepe enim dolore aut numquam ut doloribus beatae atque nihil provident voluptatem consequuntur sequi sed quaerat sed aliquid corporis dolores natus dolor sint ea.</p>
                </div>
                <h2 class="heading_a">Some text below the overflow container</h2>
                <p>Ipsum beatae optio magnam consectetur iste aut aut nihil id dolor totam sed repellat animi suscipit ex numquam quisquam debitis autem ea non occaecati esse laborum temporibus vel ut laborum explicabo magnam ratione et repellat vel labore quasi non rem consequuntur qui dolore eligendi eos explicabo cumque.</p>
            </div>
        </div>
    </div>



    <div class="uk-width-medium-1-3">
        <p class="uk-text-large">Overflow container in modal</p>
        <button class="md-btn" data-uk-modal="{target:'#modal_overflow-2'}">Open</button>
        <div id="modal_overflow-2" class="uk-modal">
            <div class="uk-modal-dialog uk-modal-dialog-large">
                <button type="button" class="uk-modal-close uk-close"></button>
                <h2 class="heading_a">Historila de Interacciones</h2>
                <p>Quia porro id amet eos optio veniam repudiandae repudiandae quae ipsam dolores dolores eveniet qui et consequatur molestiae minima eos qui et esse optio et iusto vel quis delectus numquam saepe saepe reiciendis cupiditate libero voluptates magnam est facilis.</p>
                <div class="uk-overflow-container">
                    <h2 class="heading_b">Overflow container</h2>
                    <img src="assets/img/gallery/Image06.jpg" alt=""/>
                    <p>Porro vel tenetur explicabo aut doloribus consectetur esse quibusdam facere aliquam ducimus repellendus voluptatem eum veritatis corporis quidem assumenda ut et aut reiciendis maiores mollitia commodi sapiente officia est qui unde placeat iste dolores id non ducimus et rerum quo est magni harum veritatis eaque illo sed consectetur atque ea expedita blanditiis vel fuga explicabo aut quia perferendis quis doloremque consectetur eos ea aut porro debitis reiciendis natus dolorum non fugit expedita ipsam rerum deserunt tenetur impedit veritatis accusamus praesentium voluptatem deserunt dolorem aut aperiam et quidem at earum blanditiis voluptatem eum vero recusandae provident reiciendis quos et eos et facere repellendus deserunt quibusdam dolore facilis nesciunt hic recusandae magnam atque sit sunt nemo odio pariatur non natus minima laborum est qui similique quisquam dolore nostrum sequi assumenda soluta dignissimos quia tenetur aliquam dolore distinctio sint modi non quibusdam est et voluptatem odio esse non similique occaecati qui voluptas qui tempore perferendis quo voluptatum praesentium numquam et earum itaque facilis tempore asperiores molestiae perspiciatis ut officiis omnis non sit et sequi rerum eum accusantium delectus autem rem velit laborum vitae sit iste a nobis eos aliquam enim impedit esse aut voluptatibus distinctio quae et dolorem voluptatem earum praesentium repellendus occaecati qui quasi quia beatae molestiae non cumque tempore maxime dolore est ut sit reprehenderit asperiores ea architecto ipsa beatae aut suscipit dignissimos voluptas quo qui quisquam amet sapiente modi aut sunt neque hic cum quia non sunt sed quas sit eos molestiae incidunt rem illum ut saepe tempora voluptates consequuntur accusantium saepe molestias sed voluptatibus atque aut commodi quod at consequuntur rerum aut autem et perspiciatis magnam facilis dolorum ut sit voluptatem dolor fugiat sit libero suscipit est vero unde ut accusamus et reprehenderit earum ut tempore eum et tenetur corporis quia unde deleniti quia culpa reiciendis dolorem rem aliquam eius minima debitis dolore facilis reiciendis repellendus debitis nobis at sed ducimus omnis.</p>
                    <p>Aut facilis fugit voluptates culpa quia nihil tempora blanditiis iure modi tempora minima sunt explicabo rem voluptatem voluptas optio dolore quibusdam omnis sapiente assumenda illum modi dicta dolor eaque aut sit odit esse nulla qui odit qui deserunt dolor sunt ut quod ullam iste sint delectus voluptas facere optio accusamus rerum dolorem vitae eos ullam ratione qui quas mollitia sint illum omnis atque nisi earum est sint dolores nostrum minima nam est neque quasi exercitationem molestiae saepe est qui autem id impedit ea corporis ipsum aut modi ut ipsam ex iusto odit minus incidunt facere repudiandae odit facere nobis quaerat sed quo ducimus recusandae debitis harum et quas qui quia sunt minima architecto eveniet non repellat ab modi sit deleniti quam itaque eum qui voluptatum ut rerum iusto quidem sequi perspiciatis est aliquid unde ut minus est recusandae explicabo incidunt aut iusto aut est rerum autem odit nemo aliquam et ea natus asperiores necessitatibus ipsum nam ut est laudantium aspernatur ut non dicta optio nam fuga minus quaerat earum iste asperiores rerum quo doloribus quia vero quod labore quod aliquam similique ipsa quos beatae ut asperiores sit voluptatem aperiam quis quis sit nesciunt et quasi quas voluptatum vero occaecati iste ut doloribus aut ea veniam fuga autem doloribus sapiente possimus animi odio illo enim qui minima laborum est sed voluptas praesentium et consequatur facere a repellendus sequi vero et minus sit consequatur excepturi adipisci veritatis itaque laboriosam quo eos cum omnis aut ad quod qui assumenda fuga voluptas ut blanditiis voluptate est vel libero fugit et voluptatem aliquam odio expedita fuga et sunt aut sunt eum voluptas omnis molestiae odio natus saepe suscipit et et assumenda qui distinctio dolores maiores illum tempora animi consectetur fugiat voluptatum eos necessitatibus rerum sapiente dolor impedit nihil ratione vel commodi non.</p>
                    <p>Id tempora corrupti dicta tempora et dolorem excepturi doloribus placeat culpa repudiandae vel ab tempore temporibus accusamus commodi qui exercitationem rerum quibusdam quasi optio autem cum labore voluptatem atque officia dicta voluptas odio esse id deserunt veritatis vitae omnis at explicabo quis dicta dicta atque possimus deleniti vitae ducimus corrupti blanditiis doloremque fugiat eos eveniet repellat in sed amet sed ut veniam iste et quaerat velit qui quo molestias quae ut sequi eum deserunt hic expedita voluptates consequuntur dolor laboriosam iure quis vero deleniti possimus nihil qui voluptate molestiae aperiam excepturi ex tempora doloribus hic nihil atque quo quibusdam laudantium odit quia occaecati eum inventore animi ea ea unde est occaecati natus expedita debitis iste maiores est laboriosam qui dicta voluptatum et est ut ducimus ut aut magni similique iste recusandae iusto vel perferendis facilis voluptatem sapiente delectus in doloremque exercitationem et reprehenderit quos ad omnis delectus incidunt sed blanditiis expedita rerum iusto at tenetur cupiditate ut ut natus distinctio dolore temporibus occaecati repellendus cum dolorum repellat facere quidem quaerat aliquam aspernatur nemo laudantium nisi earum et aut provident ab et voluptatibus consequatur illo illum id nihil magni ut officiis deserunt et nostrum placeat esse fugit provident architecto aliquam consequuntur ad soluta fugit ut iusto quisquam rerum sit voluptates similique voluptatibus et eius dolor sapiente iure doloribus quia vero et consequuntur commodi reiciendis itaque velit error distinctio similique quo similique sed tenetur dolore unde temporibus ab quia eaque natus et quasi pariatur ut enim qui neque et corrupti sed est nemo quibusdam rerum voluptatem repudiandae at velit deserunt qui qui recusandae voluptatem qui earum quae architecto illum necessitatibus adipisci et et voluptas consequatur aut autem quo aut tempore voluptatibus esse reiciendis.</p>
                    <p>Repellat consequuntur est nesciunt explicabo veniam id autem voluptatem corporis veniam ad fugiat provident ipsum explicabo qui dolores perspiciatis enim est omnis dolorem ut minus a blanditiis delectus quia a sed et et accusamus quia qui sunt assumenda ratione et dolorem quis eos id autem impedit dolores provident modi inventore dolor aut mollitia excepturi quis illum mollitia repellat cumque nesciunt consequatur maxime quidem dolores consequatur perspiciatis pariatur debitis nobis officiis sed ea aut voluptatem quidem velit sapiente eligendi dolor porro et aperiam aut iste et vero qui eveniet odio impedit labore vel repellendus quis debitis quia ipsum id officia quia aliquid totam consequatur debitis et facere quibusdam laboriosam exercitationem asperiores minima velit aut qui porro necessitatibus id sint incidunt sit voluptatem id id pariatur qui provident sed vitae nesciunt vero nobis in ipsam ut eum eos accusantium enim iste assumenda nesciunt veritatis unde alias voluptates qui doloremque sed modi et vero omnis qui ipsa porro ut deleniti molestiae dolorem sint quam et nemo nemo optio sapiente quo similique voluptas repudiandae aut quidem est cum ut ut adipisci unde ut id et nostrum labore atque ab autem esse est commodi commodi itaque ipsum totam est excepturi sint aut ipsa repudiandae consequatur qui error assumenda molestias cum cupiditate perspiciatis quisquam eum ratione doloribus aperiam iusto laboriosam quia vitae explicabo non natus quia nihil et quaerat qui placeat nihil sequi omnis architecto et rerum animi ut in rerum debitis reiciendis soluta dicta enim rerum saepe enim dolore aut numquam ut doloribus beatae atque nihil provident voluptatem consequuntur sequi sed quaerat sed aliquid corporis dolores natus dolor sint ea.</p>
                </div>
                <h2 class="heading_a">Some text below the overflow container</h2>
                <p>Ipsum beatae optio magnam consectetur iste aut aut nihil id dolor totam sed repellat animi suscipit ex numquam quisquam debitis autem ea non occaecati esse laborum temporibus vel ut laborum explicabo magnam ratione et repellat vel labore quasi non rem consequuntur qui dolore eligendi eos explicabo cumque.</p>
            </div>
        </div>
    </div>



    <div class="uk-width-medium-1-3">
        <p class="uk-text-large">Overflow container in modal</p>
        <button class="md-btn" data-uk-modal="{target:'#modal_overflow-3'}">Open</button>
        <div id="modal_overflow-3" class="uk-modal">
            <div class="uk-modal-dialog uk-modal-dialog-large">
                <button type="button" class="uk-modal-close uk-close"></button>
                <h2 class="heading_a">Visitantes por edades</h2>
                <p>Quia porro id amet eos optio veniam repudiandae repudiandae quae ipsam dolores dolores eveniet qui et consequatur molestiae minima eos qui et esse optio et iusto vel quis delectus numquam saepe saepe reiciendis cupiditate libero voluptates magnam est facilis.</p>
                <div class="uk-overflow-container">
                    <h2 class="heading_b">Overflow container</h2>
                    <img src="assets/img/gallery/Image06.jpg" alt=""/>
                    <p>Porro vel tenetur explicabo aut doloribus consectetur esse quibusdam facere aliquam ducimus repellendus voluptatem eum veritatis corporis quidem assumenda ut et aut reiciendis maiores mollitia commodi sapiente officia est qui unde placeat iste dolores id non ducimus et rerum quo est magni harum veritatis eaque illo sed consectetur atque ea expedita blanditiis vel fuga explicabo aut quia perferendis quis doloremque consectetur eos ea aut porro debitis reiciendis natus dolorum non fugit expedita ipsam rerum deserunt tenetur impedit veritatis accusamus praesentium voluptatem deserunt dolorem aut aperiam et quidem at earum blanditiis voluptatem eum vero recusandae provident reiciendis quos et eos et facere repellendus deserunt quibusdam dolore facilis nesciunt hic recusandae magnam atque sit sunt nemo odio pariatur non natus minima laborum est qui similique quisquam dolore nostrum sequi assumenda soluta dignissimos quia tenetur aliquam dolore distinctio sint modi non quibusdam est et voluptatem odio esse non similique occaecati qui voluptas qui tempore perferendis quo voluptatum praesentium numquam et earum itaque facilis tempore asperiores molestiae perspiciatis ut officiis omnis non sit et sequi rerum eum accusantium delectus autem rem velit laborum vitae sit iste a nobis eos aliquam enim impedit esse aut voluptatibus distinctio quae et dolorem voluptatem earum praesentium repellendus occaecati qui quasi quia beatae molestiae non cumque tempore maxime dolore est ut sit reprehenderit asperiores ea architecto ipsa beatae aut suscipit dignissimos voluptas quo qui quisquam amet sapiente modi aut sunt neque hic cum quia non sunt sed quas sit eos molestiae incidunt rem illum ut saepe tempora voluptates consequuntur accusantium saepe molestias sed voluptatibus atque aut commodi quod at consequuntur rerum aut autem et perspiciatis magnam facilis dolorum ut sit voluptatem dolor fugiat sit libero suscipit est vero unde ut accusamus et reprehenderit earum ut tempore eum et tenetur corporis quia unde deleniti quia culpa reiciendis dolorem rem aliquam eius minima debitis dolore facilis reiciendis repellendus debitis nobis at sed ducimus omnis.</p>
                    <p>Aut facilis fugit voluptates culpa quia nihil tempora blanditiis iure modi tempora minima sunt explicabo rem voluptatem voluptas optio dolore quibusdam omnis sapiente assumenda illum modi dicta dolor eaque aut sit odit esse nulla qui odit qui deserunt dolor sunt ut quod ullam iste sint delectus voluptas facere optio accusamus rerum dolorem vitae eos ullam ratione qui quas mollitia sint illum omnis atque nisi earum est sint dolores nostrum minima nam est neque quasi exercitationem molestiae saepe est qui autem id impedit ea corporis ipsum aut modi ut ipsam ex iusto odit minus incidunt facere repudiandae odit facere nobis quaerat sed quo ducimus recusandae debitis harum et quas qui quia sunt minima architecto eveniet non repellat ab modi sit deleniti quam itaque eum qui voluptatum ut rerum iusto quidem sequi perspiciatis est aliquid unde ut minus est recusandae explicabo incidunt aut iusto aut est rerum autem odit nemo aliquam et ea natus asperiores necessitatibus ipsum nam ut est laudantium aspernatur ut non dicta optio nam fuga minus quaerat earum iste asperiores rerum quo doloribus quia vero quod labore quod aliquam similique ipsa quos beatae ut asperiores sit voluptatem aperiam quis quis sit nesciunt et quasi quas voluptatum vero occaecati iste ut doloribus aut ea veniam fuga autem doloribus sapiente possimus animi odio illo enim qui minima laborum est sed voluptas praesentium et consequatur facere a repellendus sequi vero et minus sit consequatur excepturi adipisci veritatis itaque laboriosam quo eos cum omnis aut ad quod qui assumenda fuga voluptas ut blanditiis voluptate est vel libero fugit et voluptatem aliquam odio expedita fuga et sunt aut sunt eum voluptas omnis molestiae odio natus saepe suscipit et et assumenda qui distinctio dolores maiores illum tempora animi consectetur fugiat voluptatum eos necessitatibus rerum sapiente dolor impedit nihil ratione vel commodi non.</p>
                    <p>Id tempora corrupti dicta tempora et dolorem excepturi doloribus placeat culpa repudiandae vel ab tempore temporibus accusamus commodi qui exercitationem rerum quibusdam quasi optio autem cum labore voluptatem atque officia dicta voluptas odio esse id deserunt veritatis vitae omnis at explicabo quis dicta dicta atque possimus deleniti vitae ducimus corrupti blanditiis doloremque fugiat eos eveniet repellat in sed amet sed ut veniam iste et quaerat velit qui quo molestias quae ut sequi eum deserunt hic expedita voluptates consequuntur dolor laboriosam iure quis vero deleniti possimus nihil qui voluptate molestiae aperiam excepturi ex tempora doloribus hic nihil atque quo quibusdam laudantium odit quia occaecati eum inventore animi ea ea unde est occaecati natus expedita debitis iste maiores est laboriosam qui dicta voluptatum et est ut ducimus ut aut magni similique iste recusandae iusto vel perferendis facilis voluptatem sapiente delectus in doloremque exercitationem et reprehenderit quos ad omnis delectus incidunt sed blanditiis expedita rerum iusto at tenetur cupiditate ut ut natus distinctio dolore temporibus occaecati repellendus cum dolorum repellat facere quidem quaerat aliquam aspernatur nemo laudantium nisi earum et aut provident ab et voluptatibus consequatur illo illum id nihil magni ut officiis deserunt et nostrum placeat esse fugit provident architecto aliquam consequuntur ad soluta fugit ut iusto quisquam rerum sit voluptates similique voluptatibus et eius dolor sapiente iure doloribus quia vero et consequuntur commodi reiciendis itaque velit error distinctio similique quo similique sed tenetur dolore unde temporibus ab quia eaque natus et quasi pariatur ut enim qui neque et corrupti sed est nemo quibusdam rerum voluptatem repudiandae at velit deserunt qui qui recusandae voluptatem qui earum quae architecto illum necessitatibus adipisci et et voluptas consequatur aut autem quo aut tempore voluptatibus esse reiciendis.</p>
                    <p>Repellat consequuntur est nesciunt explicabo veniam id autem voluptatem corporis veniam ad fugiat provident ipsum explicabo qui dolores perspiciatis enim est omnis dolorem ut minus a blanditiis delectus quia a sed et et accusamus quia qui sunt assumenda ratione et dolorem quis eos id autem impedit dolores provident modi inventore dolor aut mollitia excepturi quis illum mollitia repellat cumque nesciunt consequatur maxime quidem dolores consequatur perspiciatis pariatur debitis nobis officiis sed ea aut voluptatem quidem velit sapiente eligendi dolor porro et aperiam aut iste et vero qui eveniet odio impedit labore vel repellendus quis debitis quia ipsum id officia quia aliquid totam consequatur debitis et facere quibusdam laboriosam exercitationem asperiores minima velit aut qui porro necessitatibus id sint incidunt sit voluptatem id id pariatur qui provident sed vitae nesciunt vero nobis in ipsam ut eum eos accusantium enim iste assumenda nesciunt veritatis unde alias voluptates qui doloremque sed modi et vero omnis qui ipsa porro ut deleniti molestiae dolorem sint quam et nemo nemo optio sapiente quo similique voluptas repudiandae aut quidem est cum ut ut adipisci unde ut id et nostrum labore atque ab autem esse est commodi commodi itaque ipsum totam est excepturi sint aut ipsa repudiandae consequatur qui error assumenda molestias cum cupiditate perspiciatis quisquam eum ratione doloribus aperiam iusto laboriosam quia vitae explicabo non natus quia nihil et quaerat qui placeat nihil sequi omnis architecto et rerum animi ut in rerum debitis reiciendis soluta dicta enim rerum saepe enim dolore aut numquam ut doloribus beatae atque nihil provident voluptatem consequuntur sequi sed quaerat sed aliquid corporis dolores natus dolor sint ea.</p>
                </div>
                <h2 class="heading_a">Some text below the overflow container</h2>
                <p>Ipsum beatae optio magnam consectetur iste aut aut nihil id dolor totam sed repellat animi suscipit ex numquam quisquam debitis autem ea non occaecati esse laborum temporibus vel ut laborum explicabo magnam ratione et repellat vel labore quasi non rem consequuntur qui dolore eligendi eos explicabo cumque.</p>
            </div>
        </div>
    </div>


    <div class="uk-width-medium-1-3">
        <p class="uk-text-large">Overflow container in modal</p>
        <button class="md-btn" data-uk-modal="{target:'#modal_overflow-4'}">Open</button>
        <div id="modal_overflow-4" class="uk-modal">
            <div class="uk-modal-dialog uk-modal-dialog-large">
                <button type="button" class="uk-modal-close uk-close"></button>
                <h2 class="heading_a">Interacciones por modelos</h2>
                <p>Quia porro id amet eos optio veniam repudiandae repudiandae quae ipsam dolores dolores eveniet qui et consequatur molestiae minima eos qui et esse optio et iusto vel quis delectus numquam saepe saepe reiciendis cupiditate libero voluptates magnam est facilis.</p>
                <div class="uk-overflow-container">
                    <h2 class="heading_b">Overflow container</h2>
                    <img src="assets/img/gallery/Image06.jpg" alt=""/>
                    <p>Porro vel tenetur explicabo aut doloribus consectetur esse quibusdam facere aliquam ducimus repellendus voluptatem eum veritatis corporis quidem assumenda ut et aut reiciendis maiores mollitia commodi sapiente officia est qui unde placeat iste dolores id non ducimus et rerum quo est magni harum veritatis eaque illo sed consectetur atque ea expedita blanditiis vel fuga explicabo aut quia perferendis quis doloremque consectetur eos ea aut porro debitis reiciendis natus dolorum non fugit expedita ipsam rerum deserunt tenetur impedit veritatis accusamus praesentium voluptatem deserunt dolorem aut aperiam et quidem at earum blanditiis voluptatem eum vero recusandae provident reiciendis quos et eos et facere repellendus deserunt quibusdam dolore facilis nesciunt hic recusandae magnam atque sit sunt nemo odio pariatur non natus minima laborum est qui similique quisquam dolore nostrum sequi assumenda soluta dignissimos quia tenetur aliquam dolore distinctio sint modi non quibusdam est et voluptatem odio esse non similique occaecati qui voluptas qui tempore perferendis quo voluptatum praesentium numquam et earum itaque facilis tempore asperiores molestiae perspiciatis ut officiis omnis non sit et sequi rerum eum accusantium delectus autem rem velit laborum vitae sit iste a nobis eos aliquam enim impedit esse aut voluptatibus distinctio quae et dolorem voluptatem earum praesentium repellendus occaecati qui quasi quia beatae molestiae non cumque tempore maxime dolore est ut sit reprehenderit asperiores ea architecto ipsa beatae aut suscipit dignissimos voluptas quo qui quisquam amet sapiente modi aut sunt neque hic cum quia non sunt sed quas sit eos molestiae incidunt rem illum ut saepe tempora voluptates consequuntur accusantium saepe molestias sed voluptatibus atque aut commodi quod at consequuntur rerum aut autem et perspiciatis magnam facilis dolorum ut sit voluptatem dolor fugiat sit libero suscipit est vero unde ut accusamus et reprehenderit earum ut tempore eum et tenetur corporis quia unde deleniti quia culpa reiciendis dolorem rem aliquam eius minima debitis dolore facilis reiciendis repellendus debitis nobis at sed ducimus omnis.</p>
                    <p>Aut facilis fugit voluptates culpa quia nihil tempora blanditiis iure modi tempora minima sunt explicabo rem voluptatem voluptas optio dolore quibusdam omnis sapiente assumenda illum modi dicta dolor eaque aut sit odit esse nulla qui odit qui deserunt dolor sunt ut quod ullam iste sint delectus voluptas facere optio accusamus rerum dolorem vitae eos ullam ratione qui quas mollitia sint illum omnis atque nisi earum est sint dolores nostrum minima nam est neque quasi exercitationem molestiae saepe est qui autem id impedit ea corporis ipsum aut modi ut ipsam ex iusto odit minus incidunt facere repudiandae odit facere nobis quaerat sed quo ducimus recusandae debitis harum et quas qui quia sunt minima architecto eveniet non repellat ab modi sit deleniti quam itaque eum qui voluptatum ut rerum iusto quidem sequi perspiciatis est aliquid unde ut minus est recusandae explicabo incidunt aut iusto aut est rerum autem odit nemo aliquam et ea natus asperiores necessitatibus ipsum nam ut est laudantium aspernatur ut non dicta optio nam fuga minus quaerat earum iste asperiores rerum quo doloribus quia vero quod labore quod aliquam similique ipsa quos beatae ut asperiores sit voluptatem aperiam quis quis sit nesciunt et quasi quas voluptatum vero occaecati iste ut doloribus aut ea veniam fuga autem doloribus sapiente possimus animi odio illo enim qui minima laborum est sed voluptas praesentium et consequatur facere a repellendus sequi vero et minus sit consequatur excepturi adipisci veritatis itaque laboriosam quo eos cum omnis aut ad quod qui assumenda fuga voluptas ut blanditiis voluptate est vel libero fugit et voluptatem aliquam odio expedita fuga et sunt aut sunt eum voluptas omnis molestiae odio natus saepe suscipit et et assumenda qui distinctio dolores maiores illum tempora animi consectetur fugiat voluptatum eos necessitatibus rerum sapiente dolor impedit nihil ratione vel commodi non.</p>
                    <p>Id tempora corrupti dicta tempora et dolorem excepturi doloribus placeat culpa repudiandae vel ab tempore temporibus accusamus commodi qui exercitationem rerum quibusdam quasi optio autem cum labore voluptatem atque officia dicta voluptas odio esse id deserunt veritatis vitae omnis at explicabo quis dicta dicta atque possimus deleniti vitae ducimus corrupti blanditiis doloremque fugiat eos eveniet repellat in sed amet sed ut veniam iste et quaerat velit qui quo molestias quae ut sequi eum deserunt hic expedita voluptates consequuntur dolor laboriosam iure quis vero deleniti possimus nihil qui voluptate molestiae aperiam excepturi ex tempora doloribus hic nihil atque quo quibusdam laudantium odit quia occaecati eum inventore animi ea ea unde est occaecati natus expedita debitis iste maiores est laboriosam qui dicta voluptatum et est ut ducimus ut aut magni similique iste recusandae iusto vel perferendis facilis voluptatem sapiente delectus in doloremque exercitationem et reprehenderit quos ad omnis delectus incidunt sed blanditiis expedita rerum iusto at tenetur cupiditate ut ut natus distinctio dolore temporibus occaecati repellendus cum dolorum repellat facere quidem quaerat aliquam aspernatur nemo laudantium nisi earum et aut provident ab et voluptatibus consequatur illo illum id nihil magni ut officiis deserunt et nostrum placeat esse fugit provident architecto aliquam consequuntur ad soluta fugit ut iusto quisquam rerum sit voluptates similique voluptatibus et eius dolor sapiente iure doloribus quia vero et consequuntur commodi reiciendis itaque velit error distinctio similique quo similique sed tenetur dolore unde temporibus ab quia eaque natus et quasi pariatur ut enim qui neque et corrupti sed est nemo quibusdam rerum voluptatem repudiandae at velit deserunt qui qui recusandae voluptatem qui earum quae architecto illum necessitatibus adipisci et et voluptas consequatur aut autem quo aut tempore voluptatibus esse reiciendis.</p>
                    <p>Repellat consequuntur est nesciunt explicabo veniam id autem voluptatem corporis veniam ad fugiat provident ipsum explicabo qui dolores perspiciatis enim est omnis dolorem ut minus a blanditiis delectus quia a sed et et accusamus quia qui sunt assumenda ratione et dolorem quis eos id autem impedit dolores provident modi inventore dolor aut mollitia excepturi quis illum mollitia repellat cumque nesciunt consequatur maxime quidem dolores consequatur perspiciatis pariatur debitis nobis officiis sed ea aut voluptatem quidem velit sapiente eligendi dolor porro et aperiam aut iste et vero qui eveniet odio impedit labore vel repellendus quis debitis quia ipsum id officia quia aliquid totam consequatur debitis et facere quibusdam laboriosam exercitationem asperiores minima velit aut qui porro necessitatibus id sint incidunt sit voluptatem id id pariatur qui provident sed vitae nesciunt vero nobis in ipsam ut eum eos accusantium enim iste assumenda nesciunt veritatis unde alias voluptates qui doloremque sed modi et vero omnis qui ipsa porro ut deleniti molestiae dolorem sint quam et nemo nemo optio sapiente quo similique voluptas repudiandae aut quidem est cum ut ut adipisci unde ut id et nostrum labore atque ab autem esse est commodi commodi itaque ipsum totam est excepturi sint aut ipsa repudiandae consequatur qui error assumenda molestias cum cupiditate perspiciatis quisquam eum ratione doloribus aperiam iusto laboriosam quia vitae explicabo non natus quia nihil et quaerat qui placeat nihil sequi omnis architecto et rerum animi ut in rerum debitis reiciendis soluta dicta enim rerum saepe enim dolore aut numquam ut doloribus beatae atque nihil provident voluptatem consequuntur sequi sed quaerat sed aliquid corporis dolores natus dolor sint ea.</p>
                </div>
                <h2 class="heading_a">Some text below the overflow container</h2>
                <p>Ipsum beatae optio magnam consectetur iste aut aut nihil id dolor totam sed repellat animi suscipit ex numquam quisquam debitis autem ea non occaecati esse laborum temporibus vel ut laborum explicabo magnam ratione et repellat vel labore quasi non rem consequuntur qui dolore eligendi eos explicabo cumque.</p>
            </div>
        </div>
    </div>



@stop


@section('scripts')
    <script>

        var active = '{{session('data')}}';
        if(active=='active')
        {
            UIkit.notify("<i class='uk-icon-check'></i>  Tu perfil ha sido modificado con exito", {status:'success'},{timeout: 5});
        }

        var chart1 = c3.generate({
            bindto: '#chart1',
            data: {
                columns: [
                    ['data1', 30],
                    ['data2', 120],
                    ['data3', 300],
                    ['data4', 50]
                ],
                type: 'donut'
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78']
            },
            donut: {
                title: "nombre"
            }
        });

        var chart2 = c3.generate({
            bindto: '#chart2',
            data: {
                columns: [
                    ['data1', 30, 200, 100, 400, 150, 250, 200, 100, 400, 150, 250, 30, 200, 100, 400, 150],
                    ['data2', 50, 20, 10, 40, 15, 25, 200, 30, 200, 100, 400, 150, 100, 400, 150, 250],
                    ['data3', 50, 20, 150, 40, 15, 250, 20, 30, 200, 100, 40, 150, 100, 400, 150, 250]
                ],
                axes: {
                    data1: 'y',
                    data2: 'y2',
                    data3: 'y'
                }
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78']
            },
            axis: {
                y: {
                    padding: {top: 200, bottom: 0}
                },
                y2: {
                    padding: {top: 100, bottom: 100},
                    show: true
                }
            }
        });

        var chart3 = c3.generate({
            bindto: '#chart3',
            data: {
                columns: [
                    ['data1', 30, 200, 100, 400, 150, 250],
                    ['data2', 50, 20, 10, 40, 15, 25]
                ],
                axes: {
                    data1: 'y',
                    data2: 'y2'
                }
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']
            },
            axis: {
                y: {
                    padding: {top: 200, bottom: 0}
                },
                y2: {
                    padding: {top: 100, bottom: 100},
                    show: true
                }
            }
        });

        var chart4 = c3.generate({
            bindto: '#chart4',
            data: {
                columns: [
                    ['data1', 30, 200, 100, 400, 150, 250],
                    ['data2', 50, 20, 10, 40, 15, 25]
                ],
                axes: {
                    data1: 'y',
                    data2: 'y2'
                }
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']
            },
            axis: {
                y: {
                    padding: {top: 200, bottom: 0}
                },
                y2: {
                    padding: {top: 100, bottom: 100},
                    show: true
                }
            }
        });
    </script>
@stop