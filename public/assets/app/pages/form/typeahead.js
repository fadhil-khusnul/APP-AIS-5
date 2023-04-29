"use strict";
$(function () {
    var data = [
        "Alabama",
        "Alaska",
        "Arizona",
        "Arkansas",
        "California",
        "Colorado",
        "Connecticut",
        "Delaware",
        "Florida",
        "Georgia",
        "Hawaii",
        "Idaho",
        "Illinois",
        "Indiana",
        "Iowa",
        "Kansas",
        "Kentucky",
        "Louisiana",
        "Maine",
        "Maryland",
        "Massachusetts",
        "Michigan",
        "Minnesota",
        "Mississippi",
        "Missouri",
        "Montana",
        "Nebraska",
        "Nevada",
        "New Hampshire",
        "New Jersey",
        "New Mexico",
        "New York",
        "North Carolina",
        "North Dakota",
        "Ohio",
        "Oklahoma",
        "Oregon",
        "Pennsylvania",
        "Rhode Island",
        "South Carolina",
        "South Dakota",
        "Tennessee",
        "Texas",
        "Utah",
        "Vermont",
        "Virginia",
        "Washington",
        "West Virginia",
        "Wisconsin",
        "Wyoming",
    ];
    let token = $("#csrf").val();
    var seal = [];

    $.ajax({
        url: "/getSeal",
        type: "post",
        async: false,
        data: {
            _token: token,
        },
        success: function (response) {
            for (var i = 0; i < response.length; i++) {
                seal[i] = response[i].kode_seal;
            }
        },
    });


    function matcher(dataset) {
        return function findMatches(query, callback) {
            var matches = [];
            var regex = new RegExp(query, "i");
            dataset.forEach(function (seal) {
                if (regex.test(seal)) {
                    matches.push(seal);
                }
            });
            callback(matches);
        };
    }
    // function matcher(dataset) {
    //     return function findMatches(query, callback) {
    //         var matches = [];
    //         var regex = new RegExp(query, "i");
    //         dataset.forEach(function (data) {
    //             if (regex.test(data)) {
    //                 matches.push(data);
    //             }
    //         });
    //         callback(matches);
    //     };
    // }
    $("#typeahead-1").typeahead(
        { hint: true, highlight: true, minLength: 1 },
        { name: "states", source: matcher(data) }
    );

    console.log(seal);
    $(".seal_typehead").typeahead(
        { hint: true, highlight: true, minLength: 1 },
        { name: "seal", source: matcher(seal) }
    );


    var states = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: data,
    });

    $("#typeahead-2").typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1,
        },
        { name: "states", source: states }
    );
    var bestPictures = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("value"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch:
            "https://twitter.github.io/typeahead.js/data/films/post_1960.json",
    });

    $("#typeahead-3").typeahead(null, {
        name: "best-pictures",
        display: "value",
        source: bestPictures,
    });
    $("#typeahead-4").typeahead(null, {
        name: "best-pictures",
        display: "value",
        source: bestPictures,
        templates: {
            empty: '<div class="tt-empty-message">Not found</div>',
            suggestion: Handlebars.compile(
                '\n        <div class="tt-menu-item">\n          <div class="tt-menu-content">\n            <h4 class="tt-menu-title">{{value}}</h4>\n            <span class="tt-menu-subtitle">{{year}}</span>\n          </div>\n        </div>\n      '
            ),
        },
    });
    var nflTeams = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("team"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        identify: function identify(obj) {
            return obj.team;
        },
        prefetch: "https://twitter.github.io/typeahead.js/data/nfl.json",
    });
    function nflTeamsWithDefaults(query, sync) {
        if (query === "") {
            sync(
                nflTeams.get(
                    "Detroit Lions",
                    "Green Bay Packers",
                    "Chicago Bears"
                )
            );
        } else {
            nflTeams.search(query, sync);
        }
    }
    $("#typeahead-5").typeahead(
        { minLength: 0, highlight: true },
        { name: "nfl-teams", display: "team", source: nflTeamsWithDefaults }
    );
    var nbaTeams = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("team"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: "https://twitter.github.io/typeahead.js/data/nba.json",
    });
    var nhlTeams = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("team"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: "https://twitter.github.io/typeahead.js/data/nhl.json",
    });
    $("#typeahead-6").typeahead(
        { highlight: true },
        {
            name: "nba-teams",
            display: "team",
            source: nbaTeams,
            templates: { header: '<h3 class="tt-header">NBA Teams</h3>' },
        },
        {
            name: "nhl-teams",
            display: "team",
            source: nhlTeams,
            templates: { header: '<h3 class="tt-header">NHL Teams</h3>' },
        }
    );
});
