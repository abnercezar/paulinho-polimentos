@extends('layouts.landing')

@section('content')
<!-- Hero Section -->
<section class="w-screen min-h-screen flex flex-col items-center justify-center relative overflow-hidden bg-gradient-to-br from-slate-900 via-indigo-900 to-blue-900">
    <!-- Botão de Login no canto superior direito -->
    <div class="absolute top-6 right-6 z-20">
        <a href="{{ route('login') }}"
           class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-out">
            <!-- Ícone de login -->
            <svg class="w-5 h-5 mr-2 transition-transform duration-300 group-hover:rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4m-5-4l4-4m0 0l-4-4m4 4H3"></path>
            </svg>
            <!-- Texto do botão -->
            <span class="text-sm">Acessar Sistema</span>

            <!-- Efeito de brilho -->
            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>
    </div>
    <!-- Animated Background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900/90 via-indigo-900/80 to-blue-900/90"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] animate-pulse"></div>
        <!-- Floating particles -->
        <div class="absolute top-20 left-10 w-2 h-2 bg-blue-400 rounded-full animate-bounce opacity-60"></div>
        <div class="absolute top-40 right-20 w-1 h-1 bg-indigo-300 rounded-full animate-ping opacity-40"></div>
        <div class="absolute bottom-32 left-1/4 w-1.5 h-1.5 bg-blue-300 rounded-full animate-pulse opacity-50"></div>
        <div class="absolute top-1/3 right-1/3 w-1 h-1 bg-indigo-400 rounded-full animate-bounce opacity-70"></div>
    </div>

    <!-- Animated Car Silhouette -->
    <div class="absolute inset-0 z-5 flex items-center justify-center opacity-5">
        <svg class="w-96 h-96 animate-pulse" viewBox="0 0 100 100" fill="currentColor" class="text-blue-200">
            <path d="M20 70h60c5.5 0 10-4.5 10-10V50c0-5.5-4.5-10-10-10H75l-5-15H30l-5 15H20c-5.5 0-10 4.5-10 10v10c0 5.5 4.5 10 10 10z"/>
            <circle cx="30" cy="75" r="8"/>
            <circle cx="70" cy="75" r="8"/>
        </svg>
    </div>

    <!-- Logo with animation -->
    <div class="relative z-10 transform transition-all duration-1000 hover:scale-105 group px-4">
        <!-- Glowing background effect -->
        <div class="absolute -inset-8 bg-gradient-to-r from-blue-400 via-indigo-500 to-purple-600 rounded-3xl blur-2xl opacity-20 group-hover:opacity-40 animate-pulse transition-opacity duration-1000"></div>

        <!-- Main title with enhanced styling -->
        <h1 class="relative text-4xl md:text-6xl lg:text-7xl font-black text-center mb-12 transform transition-all duration-700 group-hover:scale-105">
            <!-- Background text for depth effect -->
            <span class="absolute inset-0 text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-700 blur-sm opacity-30">
                Paulinho Polimentos & Elisa Car-Detail
            </span>

            <!-- Main gradient text -->
            <span class="relative text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-blue-500
                         drop-shadow-2xl animate-gradient-x">
                Paulinho Polimentos
            </span>
            <br>
            <span class="relative text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-300 to-indigo-400
                         drop-shadow-2xl animate-gradient-x animation-delay-300 text-3xl md:text-5xl lg:text-6xl">
                & Elisa Car-Detail
            </span>

            <!-- Decorative elements -->
            <div class="absolute -top-4 -left-4 w-8 h-8 bg-blue-400 rounded-full opacity-60 animate-bounce animation-delay-100"></div>
            <div class="absolute -top-2 -right-6 w-6 h-6 bg-indigo-300 rounded-full opacity-50 animate-pulse animation-delay-200"></div>
            <div class="absolute -bottom-4 left-1/4 w-4 h-4 bg-purple-400 rounded-full opacity-40 animate-bounce animation-delay-300"></div>
            <div class="absolute -bottom-2 right-1/3 w-5 h-5 bg-pink-300 rounded-full opacity-30 animate-ping animation-delay-400"></div>
        </h1>

        <!-- Subtitle/tagline -->
        <div class="relative text-center">
            <p class="text-lg md:text-xl text-blue-200 font-medium tracking-wide opacity-90 group-hover:opacity-100 transition-opacity duration-500">
                ✨ <span class="text-yellow-300">Trabalhamos em Família</span> com Estética Automotiva ✨
            </p>
        </div>

    </div>

    <!-- Main Title with typewriter effect simulation -->
    <h1 class="text-6xl md:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-blue-500
               mb-8 text-center drop-shadow-2xl relative z-10 transform transition-all duration-700 hover:scale-105">
        <span class="inline-block animate-pulse">Paulinho</span>
        <span class="inline-block animate-pulse animation-delay-200">Polimentos</span>
    </h1>

    <!-- Subtitle with stagger animation -->
    <p class="text-xl md:text-2xl text-blue-100 mb-16 text-center max-w-4xl relative z-10 leading-relaxed
              transform transition-all duration-500 hover:text-white px-4 mx-auto">
              <span class="text-2xl text-indigo-600 font-bold">🎯</span>
              Somos especialistas apaixonados por estética automotiva, com mais de 5 anos transformando veículos em verdadeiras obras de arte.

⚡ Nossa missão é entregar qualidade premium com atendimento personalizado, utilizando as melhores técnicas e produtos do mercado.</p>

<!-- CTA Button with advanced animations -->
    @php
        $numeroTelefone = '5543984299429';
        $mensagem = urlencode('Olá Paulinho! Gostaria de agendar um horário para polimento automotivo. Vi seu site e fiquei interessado nos serviços!');
        $link = "https://wa.me/$numeroTelefone?text=$mensagem";
    @endphp
</section>

<!-- Services Section -->
<section class="w-screen py-20 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23ddd6fe" fill-opacity="0.1"%3E%3Cpath d="m0 40l40-40h-40v40zm40 0v-40h-40l40 40z"/%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>

    <div class="max-w-7xl mx-auto relative z-10 px-4">
        <div class="text-center mb-16">
            <h2 class="text-5xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-600 mb-6">
                Nossos Serviços
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Tecnologia de ponta e técnicas profissionais para deixar seu veículo impecável
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Service 1 - Polimento Premium -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white rounded-3xl shadow-2xl p-8 transform transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2">
                    <!-- Icon/Image container with special effects -->
                    <div class="relative mb-6 overflow-hidden rounded-2xl">
                        <img src="polimento.png"
                             alt="Polimento Premium"
                             class="w-full h-48 object-cover transform transition-all duration-700 group-hover:scale-110 group-hover:rotate-2" />
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute top-4 right-4 bg-blue-500 text-white p-2 rounded-full transform translate-x-12 group-hover:translate-x-0 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-indigo-700 mb-4 group-hover:text-blue-600 transition-colors duration-300">
                        ✨ Polimento Premium
                    </h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Técnica avançada que remove micro riscos e restaura o brilho original da pintura,
                        deixando seu veículo com acabamento de showroom.
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-blue-600 font-semibold">A partir de R$ 10.000,00</span>
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                            <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse animation-delay-100"></div>
                            <div class="w-2 h-2 bg-blue-600 rounded-full animate-pulse animation-delay-200"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 2 - Cristalização -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white rounded-3xl shadow-2xl p-8 transform transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2">
                    <div class="relative mb-6 overflow-hidden rounded-2xl">
                        <img src="cristalizacao.png"
                             alt="Cristalização"
                             class="w-full h-48 object-cover transform transition-all duration-700 group-hover:scale-110 group-hover:rotate-2" />
                        <div class="absolute inset-0 bg-gradient-to-t from-indigo-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute top-4 right-4 bg-indigo-500 text-white p-2 rounded-full transform translate-x-12 group-hover:translate-x-0 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-indigo-700 mb-4 group-hover:text-purple-600 transition-colors duration-300">
                        💎 Cristalização
                    </h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Proteção cerâmica de alta tecnologia que cria uma camada invisível de proteção,
                        garantindo durabilidade e facilidade na limpeza.
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-indigo-600 font-semibold">A partir de R$ 10.000,00</span>
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-indigo-400 rounded-full animate-pulse"></div>
                            <div class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse animation-delay-100"></div>
                            <div class="w-2 h-2 bg-indigo-600 rounded-full animate-pulse animation-delay-200"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 3 - Detalhamento Completo -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white rounded-3xl shadow-2xl p-8 transform transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2">
                    <div class="relative mb-6 overflow-hidden rounded-2xl">
                        <img src="detalhamento.png"
                             alt="Detalhamento Completo"
                             class="w-full h-48 object-cover transform transition-all duration-700 group-hover:scale-110 group-hover:rotate-2" />
                        <div class="absolute inset-0 bg-gradient-to-t from-purple-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute top-4 right-4 bg-purple-500 text-white p-2 rounded-full transform translate-x-12 group-hover:translate-x-0 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-indigo-700 mb-4 group-hover:text-pink-600 transition-colors duration-300">
                        🚗 Detalhamento Completo
                    </h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Serviço completo que inclui lavagem técnica, polimento, cristalização,
                        limpeza de estofados e proteção total do veículo.
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-purple-600 font-semibold">A partir de R$ 10.000,00</span>
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse"></div>
                            <div class="w-2 h-2 bg-purple-500 rounded-full animate-pulse animation-delay-100"></div>
                            <div class="w-2 h-2 bg-purple-600 rounded-full animate-pulse animation-delay-200"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="w-screen py-16 bg-gradient-to-t from-gray-50 to-white border-t border-gray-100">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-indigo-700 mb-6">Depoimentos</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <span class="text-lg text-gray-700 mb-2">“Serviço excelente, meu carro ficou novo!”</span>
                <span class="text-indigo-600 font-bold">— João Silva</span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <span class="text-lg text-gray-700 mb-2">“Atendimento rápido e muito profissional.”</span>
                <span class="text-indigo-600 font-bold">— Maria Oliveira</span>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <span class="text-lg text-gray-700 mb-2">“Serviço excelente, meu carro ficou novo!”</span>
                <span class="text-indigo-600 font-bold">— João Silva</span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <span class="text-lg text-gray-700 mb-2">“Atendimento rápido e muito profissional.”</span>
                <span class="text-indigo-600 font-bold">— Maria Oliveira</span>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="w-screen py-20 bg-gradient-to-br from-white via-blue-50 to-indigo-100 relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg width="80" height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23667eea" fill-opacity="0.05"%3E%3Cpath d="M20 20h40v40H20V20zm20 35a15 15 0 1 1 0-30 15 15 0 0 1 0 30z" fill-rule="evenodd"/%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>

    <div class="max-w-5xl mx-auto relative z-10 px-4">


        <!-- Social Media Section -->
        <div class="mt-2 text-center">
            <h3 class="text-3xl font-bold text-indigo-700 mb-8">Nos siga nas redes sociais</h3>
            <p class="text-lg text-gray-600 mb-12">Acompanhe nossos trabalhos e novidades!</p>

            <div class="flex flex-wrap justify-center gap-6 mb-12">
                <a href="https://instagram.com/seu_instagram" target="_blank"
                   class="group relative overflow-hidden bg-gradient-to-r from-pink-500 to-rose-500 text-white px-8 py-4 rounded-2xl shadow-lg transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-r from-pink-600 to-rose-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                    <div class="relative flex items-center gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zm4.25 3.25a5.25 5.25 0 1 1 0 10.5a5.25 5.25 0 0 1 0-10.5zm0 1.5a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5zm5.25.75a1 1 0 1 1-2 0a1 1 0 0 1 2 0z"/>
                        </svg>
                        <span class="font-semibold">Instagram</span>
                    </div>
                </a>

                <a href="https://facebook.com/seu_facebook" target="_blank"
                   class="group relative overflow-hidden bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-4 rounded-2xl shadow-lg transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-800 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                    <div class="relative flex items-center gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 5.019 3.676 9.163 8.438 9.877v-6.987h-2.54v-2.89h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89c1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.324 21.163 22 17.019 22 12z"/>
                        </svg>
                        <span class="font-semibold">Facebook</span>
                    </div>
                </a>

                <a href="https://youtube.com/channel/SEUCANAL" target="_blank"
                   class="group relative overflow-hidden bg-gradient-to-r from-red-600 to-red-700 text-white px-8 py-4 rounded-2xl shadow-lg transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-700 to-red-800 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                    <div class="relative flex items-center gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a2.994 2.994 0 0 0-2.112-2.112C19.633 3.5 12 3.5 12 3.5s-7.633 0-9.386.574a2.994 2.994 0 0 0-2.112 2.112C0 7.939 0 12 0 12s0 4.061.502 5.814a2.994 2.994 0 0 0 2.112 2.112C4.367 20.5 12 20.5 12 20.5s7.633 0 9.386-.574a2.994 2.994 0 0 0 2.112-2.112C24 16.061 24 12 24 12s0-4.061-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                        <span class="font-semibold">YouTube</span>
                    </div>
                </a>
            </div>


 <!-- Floating WhatsApp Button -->
        <div class="fixed bottom-6 right-6 z-50">
            <button onclick="abrirWhatsApp()"
               class="group relative flex items-center justify-center w-16 h-16 bg-green-500 text-white rounded-full shadow-2xl transform transition-all duration-300 hover:scale-110 hover:shadow-green-500/50 animate-bounce">
                <div class="absolute -inset-1 bg-green-400 rounded-full blur opacity-30 group-hover:opacity-60 transition-opacity duration-300"></div>
                <svg class="relative w-8 h-8 z-10" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.688"/>
                </svg>

                <!-- Tooltip -->
                <div class="absolute right-full mr-4 px-3 py-2 bg-gray-800 text-white text-sm rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                    Fale conosco no WhatsApp!
                    <div class="absolute top-1/2 left-full w-0 h-0 border-l-4 border-l-gray-800 border-t-4 border-t-transparent border-b-4 border-b-transparent transform -translate-y-1/2"></div>
                </div>
            </button>
        </div>

@endsection

<script>
function abrirWhatsApp() {
    // Faz uma requisição para um endpoint do Laravel que redireciona para o WhatsApp
    // Isso mantém a mensagem completamente oculta
    window.open('/whatsapp-redirect', '_blank');
}
</script><style>
/* Reset para garantir que não há espaços indesejados */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
}

/* Custom animations and utilities */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes gradient-x {
    0%, 100% {
        background-size: 200% 200%;
        background-position: left center;
    }
    50% {
        background-size: 200% 200%;
        background-position: right center;
    }
}

.animate-gradient-x {
    animation: gradient-x 4s ease infinite;
}

.animation-delay-100 {
    animation-delay: 0.1s;
}

.animation-delay-200 {
    animation-delay: 0.2s;
}

.animation-delay-300 {
    animation-delay: 0.3s;
}

.animation-delay-400 {
    animation-delay: 0.4s;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Custom gradient text */
.gradient-text {
    background: linear-gradient(45deg, #6366f1, #3b82f6, #8b5cf6);
    background-size: 200% 200%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradient 3s ease infinite;
}

@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Enhanced hover effects */
.hover-lift {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.hover-lift:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

/* Pulse animation for CTA */
.pulse-cta {
    animation: pulse-cta 2s infinite;
}

@keyframes pulse-cta {
    0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
    70% { box-shadow: 0 0 0 20px rgba(59, 130, 246, 0); }
    100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
}

/* Text glow effect */
.text-glow {
    text-shadow: 0 0 10px rgba(99, 102, 241, 0.5),
                 0 0 20px rgba(99, 102, 241, 0.3),
                 0 0 30px rgba(99, 102, 241, 0.1);
}

/* Responsive text scaling with smooth transitions */
@media (max-width: 768px) {
    .responsive-title {
        font-size: 2.5rem;
        line-height: 1.1;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .responsive-title {
        font-size: 4rem;
        line-height: 1.1;
    }
}

@media (min-width: 1025px) {
    .responsive-title {
        font-size: 5rem;
        line-height: 1.1;
    }
}
</style>
