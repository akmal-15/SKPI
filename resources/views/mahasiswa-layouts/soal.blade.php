@extends('mahasiswa-layouts.mahasiswa')

@section('content')
<div class="container mt-5">
    <div class="">
        <h4>MCQ Quiz</h4>
    </div>
    <div class="d-flex">
        <div class="col-md-10 col-lg-10">
            <div class="border">
                <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row justify-content-between align-items-center mcq">
                        <h6>Time</h6><span>(5 of 20)</span>
                    </div>
                </div>
                <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row align-items-center question-title">
                        <h3 class="text-danger">1. </h3>
                        <h5 class="mt-1 ml-2">Which of the following country has largest population?</h5>
                    </div>
                    <div class="ans d-block">
                        <label class="radio w-100"> <input type="radio" name="jawaban" value="brazil"> <span
                                class="w-100">Brazil</span>
                        </label>
                    </div>
                    <div class="ans d-block">
                        <label class="radio w-100"> <input type="radio" name="jawaban" value="Germany"> <span
                                class="w-100">Germany</span>
                        </label>
                    </div>
                    <div class="ans d-block">
                        <label class="radio w-100"> <input type="radio" name="jawaban" value="Indonesia">
                            <span class="w-100">Indonesia</span>
                        </label>
                    </div>
                    <div class="ans d-block ">
                        <label class="radio w-100"> <input type="radio" name="jawaban" value="Russia"> <span
                                class="w-100">Lorem ipsum dolor sit amet .</span>
                        </label>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
                    <button class="btn btn-primary d-flex align-items-center btn-danger" type="button"><i
                            class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                    <button class="btn btn-primary border-success align-items-center btn-success" type="button">Next <i
                            class="fa fa-angle-right ml-2"></i></button>
                </div>
            </div>
        </div>
        <div class="mr-auto p-3">
            <button type="button" class="btn btn-dark mb-1">1</button>
            <button type="button" class="btn btn-dark mb-1">2</button>
            <button type="button" class="btn btn-dark mb-1">3</button>
            <button type="button" class="btn btn-dark mb-1">4</button>
            <button type="button" class="btn btn-dark mb-1">5</button>
            <button type="button" class="btn btn-dark">6</button>
            <button type="button" class="btn btn-dark">7</button>
            <button type="button" class="btn btn-dark">8</button>
        </div>
    </div>
</div>
@endsection

@section('script')
<style>
    body {
        background-color: #eee;
    }

    label.radio {
        cursor: pointer;
    }

    label.radio input {
        position: absolute;
        top: 0;
        left: 0;
        visibility: hidden;
        pointer-events: none;
    }

    label.radio span {
        padding: 4px 0px;
        border: 1px solid red;
        display: inline-block;
        color: red;
        width: 100px;
        text-align: center;
        border-radius: 3px;
        margin-top: 7px;
        text-transform: uppercase;
    }

    label.radio input:checked+span {
        border-color: red;
        background-color: red;
        color: #fff;
    }

    .ans {
        margin-left: 36px !important;
    }

    .btn:focus {
        outline: 0 !important;
        box-shadow: none !important;
    }

    .btn:active {
        outline: 0 !important;
        box-shadow: none !important;
    }
</style>
@endsection