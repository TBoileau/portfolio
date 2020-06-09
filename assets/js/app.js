import '../scss/app.scss';
import $ from 'jquery';
import 'popper.js';
import 'bootstrap';
import moment from 'moment';

moment.locale("fr_FR");

if ($("#formations").length > 0) {
    $.getJSON("/api/formations", formations => {
        formations.forEach(formation => {
            $("#formations").append(`
                <div class="d-flex">
                    <div>
                        ${moment(formation.startedAt).format("YYYY")} - ${formation.endedAt === null ? "Aujourd'hui" : moment(formation.endedAt).format("YYYY")}
                    </div>
                    <div>
                        <h4>${formation.name}</h4>
                        <span class="text-muted">${formation.school} - BAC+${formation.gradeLevel}</span>
                        <p>${formation.description}</p>
                    </div>                
                </div>
            `);
        });
    })
}

if ($("#skills").length > 0) {
    $.getJSON("/api/skills", skills => {
        skills.forEach(skill => {
            $("#skills").append(`
                <li class="list-group-item">${skill.name} - ${skill.level}/10</li>
            `);
        });
    })
}

if ($("#references").length > 0) {
    $.getJSON("/api/references", references => {
        references.forEach(reference => {
            $("#references").append(`
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 my-1">
                    <div class="card">
                        <div class="card-header">
                            <h4>${reference.title}</h4>
                            <span class="text-muted">${reference.company} - ${moment(reference.startedAt).format("YYYY")} - ${reference.endedAt === null ? "Aujourd'hui" : moment(reference.endedAt).format("YYYY")}</span>
                        </div>
                        <div class="card-body">
                            <p>${reference.description}</p>
                            ${reference.medias.map(media => `
                                <img src="${media.path}" width="100%" />
                            `)}
                        </div>
                    </div>
                </div>
            `);
        });
    })
}


$("body").on("click", ".collection-item-delete", e => {
    $(e.currentTarget).closest("div").remove();
});

$("body").on("click", ".collection-add", e => {
    let collection = $(`#${e.currentTarget.dataset.collection}`);
    let prototype = collection.data('prototype');
    let index = collection.data('index');
    collection.append(prototype.replace(/__name__/g, index));
    collection.data('index', index++);
})