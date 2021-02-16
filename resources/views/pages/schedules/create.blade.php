@extends('layouts.app')

@section('title')
    Create Schedule
@endsection

@section('head')
    <style>
        .w-75p{
            width: 75px;
        }
    </style>
@endsection

@section('content')
    <div class="container-md py-3 mt-3 border border-3 rounded-1">
        <div class="d-flex align-items-center fs-3">
            <span>Every&nbsp;</span>
            <span class="w-75p">
                <input v-model="every" :class="[formOneClass]" type="text" class="fs-3 py-0">
            </span>
            <span>&nbsp;days. In range&nbsp;</span>
            <span class="w-75p">
                <input :class="[formOneClass]" type="text" class="form-control fs-3 py-0">
            </span>
            <span>&nbsp;to&nbsp;</span>
            <span class="w-75p">
                <input :class="[formOneClass]" type="text" class="form-control fs-3 py-0">
            </span>
            <span>
                <button @click="scheduleDataPhaseOne" :class="[isFormOneSubmitted ? 'btn-secondary' : 'btn-primary']" class="btn fs-3 py-0 ms-3">@{{ isFormOneSubmitted ? 'edit' : 'submit'}}</button>
            </span>
        </div>
        <div class="d-flex align-items-center mt-3 fs-3">
            <span>&nbsp;on day&nbsp;</span>
            <span class="w-75p">
                <input type="text" class="form-control fs-3 py-0">
            </span>
            <span>&nbsp;, on time&nbsp;</span>
            <span class="w-75p">
                <input type="text" class="form-control fs-3 py-0">
            </span>
            <span>&nbsp;:&nbsp;</span>
            <span class="w-75p">
                <input type="text" class="form-control fs-3 py-0">
            </span>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var app = new Vue({
            el: '#app',
            data() {
                return {
                    every: "",
                    start: "",
                    end: "",
                    day: "",
                    hour: "",
                    minute: "",
                    isFormOneSubmitted: false
                };
            },
            computed: {
                formOneClass() {
                    return this.isFormOneSubmitted ? 'form-control-plaintext' : 'form-control';
                }
            },
            methods: {
                scheduleDataPhaseOne() {
                    this.isFormOneSubmitted = ! this.isFormOneSubmitted;
                }
            }
        });

    </script>
@endsection
