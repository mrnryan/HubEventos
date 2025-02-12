@extends('layout')

@section('content')

<section class="dark:bg-gray-100 dark:text-gray-800 max-w-6xl mx-auto rounded-lg">
	<div class="container flex flex-col justify-center p-4 mx-auto mt-10 md:p-8">
		<p class="p-2 text-sm font-medium tracking-wider text-center uppercase">Sobre o Portal</p>
		<h2 class="mb-12 text-4xl font-bold leading-none text-center sm:text-4xl">Inovação e Formação de Eventos do IFRN</h2>
		<div class="flex flex-col divide-y sm:px-8 lg:px-12 xl:px-32 dark:divide-gray-300">
			<details>
				<summary class="py-2 outline-none cursor-pointer focus:underline">Por que este portal existe?</summary>
				<div class="px-4 pb-4">
					<p>O portal de eventos foi criado com o objetivo de melhorar a comunicação e facilitar o acesso às informações sobre eventos acadêmicos, culturais e institucionais no IFRN. Muitas vezes, a 
                        divulgação de eventos acontece por meio de redes sociais como Instagram e WhatsApp, que, apesar de populares, não são ideais para a organização das 
                        informações. Isso pode levar a falhas na comunicação, baixa visibilidade dos eventos e dificuldades no processo de inscrição.
                    </p>
				</div>
			</details>
			<details>
				<summary class="py-2 outline-none cursor-pointer focus:underline">Como surgiu a ideia?</summary>
				<div class="px-4 pb-4">
					<p>A necessidade de um sistema mais eficiente ficou evidente diante dos desafios enfrentados por alunos e organizadores de eventos. Sem uma plataforma centralizada, muitas 
                        informações se perdem, dificultando a participação dos estudantes e tornando a gestão dos eventos mais complexa. A ideia do portal nasceu para solucionar esse problema, 
                        criando um espaço único e acessível para consultar eventos, realizar inscrições atravez das informações dos eventos e esclarecer dúvidas de forma simples e rápida.
                    </p>
				</div>
			</details>
			<details>
				<summary class="py-2 outline-none cursor-pointer focus:underline">O que oferecemos?</summary>
				<div class="px-4 pb-4 space-y-2">
					<p>Nosso portal proporciona uma experiência mais organizada e intuitiva para todos os envolvidos. Com ele, os alunos podem:</p>
                    <p>✅ Acompanhar todos os eventos em um só lugar</p>
                    <p>✅ Obter informações sobre os eventos de forma prática</p>
                    <p>✅ Tirar dúvidas através do chat interativo</p>
                    <p>✅ Ter um destaque para eventos permanentes</p>
                    <p>✅ Acessibilidade para todos os usuários </p>
                    <p>Além disso, os responsáveis pelos eventos ganham uma ferramenta eficiente para divulgar informações com mais clareza 
                        e aumentar o engajamento dos participantes.
                    </p>
				</div>
			</details>
            <details>
				<summary class="py-2 outline-none cursor-pointer focus:underline">Nossa missão</summary>
				<div class="px-4 pb-4 space-y-2">
					<p>Nosso objetivo é tornar a comunicação mais eficiente e acessível, promovendo maior integração entre alunos e instituição. 
                        Acreditamos que um portal bem estruturado pode transformar a forma como os eventos são organizados e divulgados, incentivando maior participação e transparência.
                    </p>
                    <p>Seja bem-vindo ao nosso portal! 🎉</p>
				</div>
			</details>
		</div>
	</div>
</section>

@endsection