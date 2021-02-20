@extends('layouts.app')

@section('title')
    Create Schedule
@endsection

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .w-75p {
            width: 75px;
        }

    </style>
@endsection

@section('content')
    <div class="container-md py-3 mt-3 border border-3 rounded-1">
        <div class="row ">
            <div class="col-12">
                <div class="row ">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center">
                            <div style="flex: 0 0 auto;">Every&nbsp;</div>
                            <div>
                                <input v-model="every" type="text" class="form-control fs-3 py-0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center">
                            <div style="flex: 0 0 auto;">&nbsp;days. In range&nbsp;</div>
                            <div>
                                <input v-model="start" type="text" class="form-control fs-3 py-0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center">
                            <div style="flex: 0 0 auto;">&nbsp;to&nbsp;</div>
                            <div>
                                <input v-model="end" type="text" class="form-control fs-3 py-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="notif-table mt-3" v-if="notifs.length > 0">
            <table class="table">
                <thead>
                    <tr>
                        <td>day</td>
                        <td>time</td>
                        <td>action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="notif in notifs" :key="notif.id">
                        <td>@{{ notif . day }}</td>
                        <td>@{{ notif . hour + ':' + notif . minute }}</td>
                        <td>
                            <button @click="removeNotif(notif.id)" class="btn btn-danger fs-3 py-0">
                                delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row mt-3">
            <div class="col-lg-4 my-2">
                <div class="d-flex align-items-center">
                    <div style="flex: 0 0 auto;">&nbsp;schedule&nbsp;</div>
                    <div>
                        <input v-model="scheduleId" type="number" class="form-control fs-3 py-0">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-2">
                <div class="d-flex align-items-center">
                    <div style="flex: 0 0 auto;">&nbsp;on day&nbsp;</div>
                    <div>
                        <input v-model="day" type="text" class="form-control fs-3 py-0">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-2">
                <div class="d-flex align-items-center">
                    <div style="flex: 0 0 auto;">&nbsp;, on time&nbsp;</div>
                    <div>
                        <input v-model="hour" type="text" class="form-control fs-3 py-0">
                    </div>
                    <div style="flex: 0 0 auto;">&nbsp;:&nbsp;</div>
                    <div>
                        <input v-model="minute" type="text" class="form-control fs-3 py-0">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-2">
                <div class="d-flex align-items-center">
                    <div style="flex: 0 0 auto;">&nbsp; to &nbsp;</div>
                    <div>
                        <input v-model="name" type="text" class="form-control fs-3 py-0">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-2">
                <div class="d-flex align-items-center">
                    <div style="flex: 0 0 auto;">&nbsp; for &nbsp;</div>
                    <div>
                        <input v-model="course" type="text" class="form-control fs-3 py-0">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-2">
                <div class="d-flex align-items-center">
                    <div style="flex: 0 0 auto;">&nbsp; at &nbsp;</div>
                    <div>
                        <input v-model="time" type="text" class="form-control fs-3 py-0">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-2">
                <div class="d-flex align-items-center">
                    <div>
                        <button @click="addNotif" class="btn btn-success fs-3 py-0 ms-3">submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="submit-schedule mt-3">
            <button @click="submitSchedule" class="btn btn-primary fs-3 py-0">submit schedule</button>
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
                    name: "",
                    course: "",
                    time: "",
                    scheduleId: 0,
                    notifs: [],
                    nextId: 1
                };
            },
            computed: {},
            methods: {
                addNotif() {
                    new_notif = {
                        id: this.nextId,
                        day: this.day,
                        hour: this.hour,
                        minute: this.minute,
                        name: this.name,
                        course: this.course,
                        time: this.time,
                        schedule_id: this.scheduleId
                    };
                    this.nextId++;
                    this.notifs.push(new_notif);
                },
                removeNotif(id) {
                    this.notifs = this.notifs.filter(function(notif) {
                        return id != notif.id;
                    });
                },
                submitSchedule() {
                    axios({
                        method: 'post',
                        url: '/schedules',
                        data: {
                            notifs: this.notifs
                        },
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    }).then(function(res) {
                        console.log(res.data);
                    })

                }
            }
        });

    </script>
@endsection
