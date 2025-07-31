@extends('layouts.app')

@section('content')
<div class="w-full flex justify-end px-8 pt-8">
    {{-- <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-2 bg-gradient-to-r from-indigo-600 to-blue-500 text-white font-bold rounded-xl shadow-lg hover:scale-105 hover:from-indigo-700 hover:to-blue-600 transition-all duration-200">Logar <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m0 0l4-4m-4 4l4 4"/></svg></a> --}}
</div>

<section class="w-full flex flex-col items-center justify-center py-20 px-4 bg-gradient-to-b from-indigo-50 via-white to-blue-50 relative overflow-hidden">
    <div class="absolute inset-0 z-0 flex justify-center items-center pointer-events-none">
        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80" alt="Background" class="w-full h-full object-cover opacity-10" />
    </div>
    <img src="{{ asset('logo.png') }}" alt="Logo Paulinho Polimentos" class="w-40 h-40 mb-10 rounded-full shadow-2xl border-4 border-indigo-200 object-cover relative z-10" />
    <h1 class="text-5xl md:text-7xl font-extrabold text-indigo-700 mb-8 text-center drop-shadow-lg relative z-10">Paulinho Polimentos</h1>
    <p class="text-2xl md:text-3xl text-gray-700 mb-12 text-center max-w-2xl relative z-10">Especialistas em polimento automotivo. Agende, organize e controle seu negócio com facilidade!</p>
    @php
        $numeroTelefone = '5599999999999'; // Substitua pelo número real
        $mensagem = urlencode('Olá Paulinho! Gostaria de agendar um horário para polimento automotivo.');
        $link = "https://wa.me/$numeroTelefone?text=$mensagem";
    @endphp
    <a href="{{ $link }}" target="_blank" class="inline-block px-12 py-5 bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold rounded-2xl shadow-xl hover:scale-105 hover:from-indigo-600 hover:to-blue-600 transition-all text-2xl relative z-10">Agendar Horário</a>
</section>

<section class="w-full py-16 px-4 bg-white border-t border-gray-100">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="flex flex-col items-center bg-gradient-to-br from-indigo-100 to-blue-100 rounded-2xl shadow-lg p-6 hover:scale-105 transition-all duration-200">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="Trabalho 1" class="w-44 h-32 object-cover rounded-xl mb-4 shadow">
            <span class="text-lg text-indigo-700 font-bold mb-2">Polimento Premium</span>
            <span class="text-sm text-gray-600">Resultados impecáveis para seu veículo.</span>
        </div>
        <div class="flex flex-col items-center bg-gradient-to-br from-indigo-100 to-blue-100 rounded-2xl shadow-lg p-6 hover:scale-105 transition-all duration-200">
            <img src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80" alt="Trabalho 2" class="w-44 h-32 object-cover rounded-xl mb-4 shadow">
            <span class="text-lg text-indigo-700 font-bold mb-2">Cristalização</span>
            <span class="text-sm text-gray-600">Cada cliente é único para nós.</span>
        </div>
        <div class="flex flex-col items-center bg-gradient-to-br from-indigo-100 to-blue-100 rounded-2xl shadow-lg p-6 hover:scale-105 transition-all duration-200">
            <img src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=400&q=80" alt="Trabalho 3" class="w-44 h-32 object-cover rounded-xl mb-4 shadow">
            <span class="text-lg text-indigo-700 font-bold mb-2">Lavagem</span>
            <span class="text-sm text-gray-600">Gestão fácil e visual do seu caixa.</span>
        </div>
    </div>
</section>

<section class="w-full py-16 px-4 bg-gradient-to-t from-gray-50 to-white border-t border-gray-100">
    <div class="max-w-4xl mx-auto text-center">
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
    </div>
</section>

<section class="w-full py-16 px-4 bg-white border-t border-gray-100">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-indigo-700 mb-6">Sobre Nós</h2>
        <p class="text-lg text-gray-700 mb-8">Somos especialistas em polimentos automotivos, com atendimento personalizado e foco na satisfação do cliente. Nosso sistema facilita o agendamento, controle financeiro e gestão de clientes para você ter mais tempo e tranquilidade.</p>
        <div class="flex justify-center gap-6 mb-6">
            <a href="https://instagram.com/seu_instagram" target="_blank" class="flex items-center gap-2 px-5 py-2 bg-pink-100 text-pink-700 rounded-lg shadow hover:bg-pink-200 transition">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zm4.25 3.25a5.25 5.25 0 1 1 0 10.5a5.25 5.25 0 0 1 0-10.5zm0 1.5a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5zm5.25.75a1 1 0 1 1-2 0a1 1 0 0 1 2 0z"/></svg>
                Instagram
            </a>
            <a href="https://facebook.com/seu_facebook" target="_blank" class="flex items-center gap-2 px-5 py-2 bg-blue-100 text-blue-700 rounded-lg shadow hover:bg-blue-200 transition">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 5.019 3.676 9.163 8.438 9.877v-6.987h-2.54v-2.89h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89c1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.324 21.163 22 17.019 22 12z"/></svg>
                Facebook
            </a>
        </div>
        <a href="https://youtube.com/channel/SEUCANAL" target="_blank" class="inline-flex items-center gap-2 px-8 py-3 bg-red-100 text-red-700 font-semibold rounded-lg shadow hover:bg-red-200 transition-all text-lg">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a2.994 2.994 0 0 0-2.112-2.112C19.633 3.5 12 3.5 12 3.5s-7.633 0-9.386.574a2.994 2.994 0 0 0-2.112 2.112C0 7.939 0 12 0 12s0 4.061.502 5.814a2.994 2.994 0 0 0 2.112 2.112C4.367 20.5 12 20.5 12 20.5s7.633 0 9.386-.574a2.994 2.994 0 0 0 2.112-2.112C24 16.061 24 12 24 12s0-4.061-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            YouTube
        </a>
    </div>
    <footer class="mt-12 pt-8 border-t border-gray-200 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} Paulinho Polimentos. Todos os direitos reservados.
    </footer>
    </div>
</section>


@endsection
