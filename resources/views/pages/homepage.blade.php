@extends('layouts.app')

@section('title')
    Home
@endsection

@section('head')
    
@endsection

@section('content')
    <span :title="message">@{{ msg }}</span>
    <button @click="messageChange">bbbbb</button>
@endsection

@section('scripts')
<script>
    var app2 = new Vue({
        el: '#app',
        data(){
            return {
                message: 'You loaded this page on ' + new Date().toLocaleString(),
                msg: "fitz"
            };
        },
        methods:{
            messageChange(){
                this.msg = new Date().toISOString();
            }
        }
    });
</script>
@endsection