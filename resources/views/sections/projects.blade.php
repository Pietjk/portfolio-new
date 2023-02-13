<section class="relative z-10" id="projects">
    <div class="container mx-auto text-white max-w-[1024px]">
        @include('components._header', [$text = 'Projecten'])
        <div class="grid md:grid-cols-2 grid-cols-1 gap-y-5 gap-x-10 px-10 py-5 projects">
        @include('components._project', [
                $project = 'Ruben Korfmaker',
                $text = 'Deze website heb ik gemaakt voor mijn vader. Hij stond toen op het punt om zijn nieuwe boek uit te brengen en had daar een website bij nodig. De website heb ik geschreven in <code>PhP/Laravel</code> met een vleugje <code>Javascript</code>. En om het er een beetje mooi uit te laten zien heb ik het css framework <code>Bulma</code> gebruikt. Het heeft een hele custom backend voor het bijhouden van de data die wordt weergegeven op de voorkant.',
                $image = asset('images/landings/rubenkorfmaker.png'),
                $order = [1,2,2,1],
                $alt = 'De Ruben Korfmaker landing pagina',
                $site = 'https://www.rubenkorfmaker.nl/',
                $github = 'https://github.com/Pietjk/boeksite'
        ])
            
            @include('components._project', [
                $project = 'De Breimeisjes',
                $text = 'Mijn moeder houdt al jaren een blog bij. Daarnaast had ze ook een website, maar die was absoluut aan een update toe. Ik heb deze website geschreven in <code>PhP/Laravel</code>. De styling is gedaan met <code>Bootstrap 5</code>. Deze site heeft ook een backend voor het aanpassen van de content aan de voorkant. Ook heeft deze website een connectie met de Ravelry API voor het weergeven van de producten in de Ravelry winkel.',
                $image = asset('images/landings/debreimeisjes.png'),
                $order = [4,4,3,3],
                $alt = 'De Breimeisjes landing pagina',
                $site = 'https://www.debreimeisjes.nl/',
                $github = 'https://github.com/Pietjk/debreimeisjes'
            ])

            
            @include('components._project', [
                $project = 'Tige Site',
                $text = 'Deze website ben ik gestart met een paar vrienden. Het idee erachter was om een website te hebben om een aantal oefen projecten op te doen. De website draait op <code>PhP/Laravel</code> en wordt gestyled met <code>Bootstrap 5</code>. Met oefen projecten met bijvoorbeeld <code>Vue/Javascript</code>.',
                $image = asset('images/landings/tige.png'),
                $order = [5,6,6,5],
                $alt = 'De Tige site landing pagina',
                $site = 'https://www.tige.site/',
                $github = 'https://github.com/exact3musketiers/Tiege'
            ])

            
            @include('components._project', [
                $project = 'Postis IT Group',
                $text = 'De website van mijn huidige werk. Deze website heb ik helemaal van de grond af ontworpen en daarna inelkaar gestyled. Het heeft allemaal interessante coole styling elementen. Op dit moment is een groot deel nog niet zichtbaar omdat de texten daarvoor nog niet geschreven zijn. Geschreven in <code>PhP/Laravel</code> en <code>Boostrap 5</code>.',
                $image = asset('images/landings/postis.png'),
                $order = [8,8,7,7],
                $alt = 'De Postis IT landing pagina',
                $site = 'https://www.postis.it/',
                $github = ''
            ])

            
        </div>
    </div>
</section>
