<div class="card-body">
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Referral') }}
            </h2>
        </header>
        <div class="input-group">
            @if ($referral_url)
                <input type="text" class="form-control" id="referralLinks" readonly value="{{$referral_url}}">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" onclick="copyReferralLinks()">
                        <i class="bx bx-copy"></i> Copy
                    </button>
                </div>
            @else
                <form method="post" action="{{ route('referral.code') }}">
                    @csrf
                    @method('post')
                    {{ __('no referral code.') }}
                    <br>
                    <input type="hidden" name="generateCode" value="generateCode">
                    <button class="btn btn-sm btn-primary">
                        <i class="bx bx-plus-circle"></i> Crear Codigo de Referido
                    </button>
                </form>
            @endif
        </div>
        <br>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Referral List.') }}
        </p>
        <div class="container" style="margin-top:30px;">
            <div class="row">
                @if ($rcount > 0) 
                    @foreach ($father as $key => $item)
                        <div class="col-md-4">
                            <ul id="tree{{($key + 1)}}" style="border: 1px solid blue; cursor:pointer;">
                                <li>
                                @if($item['child']['name'] != null && $item['child']['lastName'] != null)
                                    <a href="#">{{$item['child']['name']}} {{$item['child']['lastName']}} 6%</a>
                                    @if($item['child']['grandchild']['name'] != null && $item['child']['grandchild']['lastName'] != null) 
                                        <ul>
                                            <li>{{$item['child']['grandchild']['name']}} {{$item['child']['grandchild']['lastName']}} 4%</li>
                                        </ul>
                                    @endif
                                @else
                                    <a href="#">No tiene referidos</a>
                                @endif
                                </li>
                            </ul>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-4">
                        <ul id="treeDefault" style="border: 1px solid blue; cursor:pointer;">
                            <li>
                                <a href="#">No tiene refereridos</a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
<style>
    .tree, .tree ul {
        margin:0;
        padding:0;
        list-style:none
    }
    .tree ul {
        margin-left:1em;
        position:relative
    }
    .tree ul ul {
        margin-left:.5em
    }
    .tree ul:before {
        content:"";
        display:block;
        width:0;
        position:absolute;
        top:0;
        bottom:0;
        left:0;
        border-left:1px solid
    }
    .tree li {
        margin:0;
        padding:0 1em;
        line-height:2em;
        color:#369;
        font-weight:700;
        position:relative
    }
    .tree ul li:before {
        content:"";
        display:block;
        width:10px;
        height:0;
        border-top:1px solid;
        margin-top:-1px;
        position:absolute;
        top:1em;
        left:0
    }
    .tree ul li:last-child:before {
        background:#fff;
        height:auto;
        top:1em;
        bottom:0
    }
    .indicator {
        margin-right:5px;
    }
    .tree li a {
        text-decoration: none;
        color:#369;
    }
    .tree li button, .tree li button:active, .tree li button:focus {
        text-decoration: none;
        color:#369;
        border:none;
        background:transparent;
        margin:0px 0px 0px 0px;
        padding:0px 0px 0px 0px;
        outline: 0;
    }
</style>
<script>
$.fn.extend({
    treed: function (o) {
        var openedClass = 'bx-no-entry';
        var closedClass = 'bx-plus-circle';
        
        if (typeof o != 'undefined'){
            if (typeof o.openedClass != 'undefined'){
                openedClass = o.openedClass;
            }
            if (typeof o.closedClass != 'undefined'){
                closedClass = o.closedClass;
            }
        };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator bx " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
        tree.find('.branch .indicator').each(function(){
            $(this).on('click', function () {
                $(this).closest('li').click();
            });
        });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

//Initialization of treeviews
let count = {{$rcount}};
for (let index = 1; index <= count; index++) {
    $('#tree'+index).treed();
}

$('#treeDefault').treed();

function copyReferralLinks() {
    var input = document.getElementById("referralLinks");

    // Select the input
    input.select();
    // For mobile devices
    input.setSelectionRange(0, 99999); 

    // Copy the text inside the input
    document.execCommand("copy");

    // Confirmed copied text
    alert("Your referral link has been copied: " + input.value);
}
</script>