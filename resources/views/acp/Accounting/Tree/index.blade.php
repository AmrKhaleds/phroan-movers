@extends('acp.layout.app')

@section('title')
    @lang('back.tree_accounting')
@endsection

@section('css')

    <style>


        #fontSizeWrapper {
            font-size: 16px;
        }

        #fontSize {
            width: 100px;
            font-size: 1em;
        }

        /* ————————————————————–
          Tree core styles
        */
        .tree {
            margin: 2em;
            list-style-type: none;
        }

        .tree input {
            position: absolute;
            clip: rect(0, 0, 0, 0);
        }

        .tree input ~ ul {
            display: none;
        }

        .tree input:checked ~ ul {
            list-style-type: none;
            display: block;
        }

        /* ————————————————————–
          Tree rows
        */
        .tree li {
            line-height: 1.2;
            position: relative;
            padding: 1em 1em 1em 1em;
        }

        .tree ul li {
            padding: 1em 1em 0 0;
        }

        .tree > li:last-child {
            padding-bottom: 0;
        }

        /* ————————————————————–
          Tree labels
        */
        .tree_label {
            position: relative;
            display: inline-block;
            background: #fff;
        }

        label.tree_label {
            cursor: pointer;
        }

        label.tree_label:hover {
            color: #666;
        }

        /* ————————————————————–
          Tree expanded icon
        */
        label.tree_label:before {
            background: #000;
            color: #fff;
            position: relative;
            z-index: 1;
            float: right;
            margin: 0 -2em 0 1em;
            width: 1em;
            height: 1em;
            border-radius: 1em;
            content: '+';
            text-align: center;
            line-height: .9em;
        }

        :checked ~ label.tree_label:before {
            content: '–';
        }

        /* ————————————————————–
          Tree branches
        */
        .tree li:before {
            position: absolute;
            top: 0;
            bottom: 0;
            right: -.5em;
            display: block;
            width: 0;
            border-right: 1px solid #777;
            content: "";
        }

        .tree_label:after {
            position: absolute;
            top: 0;
            right: -1.5em;
            display: block;
            height: 0.5em;
            width: 1em;
            border-bottom: 1px solid #777;
            border-right: 1px solid #777;
            border-radius: 0 0 0 .3em;
            content: '';
        }

        label.tree_label:after {
            border-bottom: 0;
        }

        :checked ~ label.tree_label:after {
            border-radius: 0 .3em 0 0;
            border-top: 1px solid #777;
            border-left: 1px solid #777;
            border-bottom: 0;
            border-right: 0;
            bottom: 0;
            top: 0.5em;
            height: auto;
        }

        .tree li:last-child:before {
            height: 1em;
            bottom: auto;
        }

        .tree > li:last-child:before {
            display: none;
        }

        .tree_custom {
            display: block;
            background: #eee;
            padding: 1em;
            border-radius: 0.3em;
        }
    </style>
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.tree_accounting')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.tree_accounting')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-container">
                        <ul class="tree">

                            @foreach($trees->where('parent_id',0) as $l => $tree)
                                @if(count($tree->children) > 0)
                                    <li>
                                        <input type="checkbox" id="c{{$tree->account_name}}"/>
                                        <label class="tree_label"
                                               for="c{{$tree->account_name}}">{{$tree->name}}</label>
                                        <ul>
                                            @foreach($tree->children as $l2 => $children1)
                                                @if(count($children1->children) > 0)
                                                    <li>

                                                        <input type="checkbox" id="c{{$children1->account_name}}"/>
                                                        <label for="c{{$children1->account_name}}"
                                                               class="tree_label">{{$children1->account_name}}
                                                            #{{$children1->num}}</label>
                                                        <ul>
                                                            @foreach($children1->children as $l3 => $children2)
                                                                @if(count($children2->children) > 0)
                                                                    <li>
                                                                        <input type="checkbox"
                                                                               id="c{{$children2->account_name}}"/>
                                                                        <label for="c{{$children2->account_name}}"
                                                                               class="tree_label">{{$children2->account_name}}
                                                                            #{{$children2->num}}</label>
                                                                        <ul>
                                                                            @foreach($children2->children as $l4 => $children3)
                                                                                @if(count($children3->children) > 0)
                                                                                    <li>
                                                                                        <input type="checkbox"
                                                                                               id="c{{$children3->account_name}}"/>
                                                                                        <label for="c{{$children3->account_name}}"
                                                                                               class="tree_label">{{$children3->account_name}}
                                                                                            #{{$children3->num}}</label>

                                                                                        <ul>
                                                                                            @foreach($children3->children as $l3 => $children4)
                                                                                                @if(count($children4->children) > 0)
                                                                                                    <li>
                                                                                                        <input type="checkbox"
                                                                                                               id="c{{$children4->account_name}}"/>
                                                                                                        <label for="c{{$children4->account_name}}"
                                                                                                               class="tree_label">{{$children4->account_name}}
                                                                                                            #{{$children4->num}}</label>

                                                                                                        <ul>
                                                                                                            @foreach($children4->children as $l3 => $children5)

                                                                                                                @if(count($children5->children) > 0)
                                                                                                                    <li>
                                                                                                                        <input type="checkbox"
                                                                                                                               id="c{{$children5->account_name}}"/>
                                                                                                                        <label for="c{{$children5->account_name}}"
                                                                                                                               class="tree_label">{{$children5->account_name}}
                                                                                                                            #{{$children5->num}}</label>

                                                                                                                        <ul>
                                                                                                                            @foreach($children5->children as $l3 => $children6)
                                                                                                                                @if(count($children6->children) > 0)
                                                                                                                                    <li>
                                                                                                                                        <input type="checkbox"
                                                                                                                                               id="c{{$children6->account_name}}"/>
                                                                                                                                        <label for="c{{$children6->account_name}}"
                                                                                                                                               class="tree_label">{{$children6->account_name}}
                                                                                                                                            #{{$children6->num}}</label>
                                                                                                                                        <ul>
                                                                                                                                            @foreach($children6->children as $l3 => $children7)
                                                                                                                                                @if(count($children7->children) > 0)
                                                                                                                                                    <li>
                                                                                                                                                        <input type="checkbox"
                                                                                                                                                               id="c{{$children7->account_name}}"/>
                                                                                                                                                        <label for="c{{$children7->account_name}}"
                                                                                                                                                               class="tree_label">{{$children7->account_name}}
                                                                                                                                                            #{{$children7->num}}</label>
                                                                                                                                                    </li>
                                                                                                                                                @else
                                                                                                                                                    <li>
                                                                                                                                                        <span class="tree_label">{{$children7->account_name}} #{{$children7->num}}</span>
                                                                                                                                                    </li>
                                                                                                                                                @endif
                                                                                                                                            @endforeach
                                                                                                                                        </ul>
                                                                                                                                    </li>
                                                                                                                                @else
                                                                                                                                    <li>
                                                                                                                                        <span class="tree_label">{{$children6->account_name}} #{{$children6->num}}</span>
                                                                                                                                    </li>
                                                                                                                                @endif
                                                                                                                            @endforeach
                                                                                                                        </ul>
                                                                                                                    </li>
                                                                                                                @else
                                                                                                                    <li>
                                                                                                                        <span class="tree_label">{{$children5->account_name}} #{{$children5->num}}</span>
                                                                                                                    </li>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                @else
                                                                                                    <li>
                                                                                                        <span class="tree_label">{{$children4->account_name}} #{{$children4->num}}</span>
                                                                                                    </li>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </li>
                                                                                @else
                                                                                    <li>
                                                                                        <span class="tree_label">{{$children3->account_name}} #{{$children3->num}}</span>
                                                                                    </li>
                                                                                @endif
                                                                            @endforeach
                                                                        </ul>
                                                                    </li>
                                                                @else
                                                                    <li>
                                                                        <span class="tree_label">{{$children2->account_name}} #{{$children2->num}}</span>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li>
                                                        <span class="tree_label">{{$children1->account_name}} #{{$children1->num}}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><span class="tree_label">{{$tree->name}}</span></li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->



@endsection
