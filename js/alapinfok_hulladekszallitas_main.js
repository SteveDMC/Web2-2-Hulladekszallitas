class Naptar {
    constructor(selector) {
        this.wrapper = $(selector);
    }
    kirajzol(napok, szallitasi_napok, igenyek) {
        this.szallitasi_napok = szallitasi_napok;
        this.igenyek = igenyek;
        this.wrapper.html('');
        for (const nap of napok) {
            this.wrapper.append(
                this.getNapHtml(nap)
            );
        }
        this.wrapper.css('visibility', 'visible');
    }
    getNapHtml(nap) {
        const class_list = ['nap'];
        let title = '';
        if (this.szallitasi_napok.map(sz => sz.datum).includes(nap.datum)) {
            class_list.push('szallitas');
            title = 'szállítási nap'
        }
        const content = `<span>${nap.nap || '&nbsp;'}</span><div>${this.getIgenyekHtml(nap)}</div>`;
        return `<div class="${class_list.join(' ')}" title="${title}">${content}</div>`;
    }
    getIgenyekHtml(nap) {
        const igeny = this.igenyek.filter(igeny => igeny.igeny === nap.datum);
        if (!igeny.length) {
            return '';
        }
        return `<img src="${IMAGES_ROOT}szemet.svg" title="szállítási igény"/>`.repeat(igeny[0].mennyiseg);
    }
}

class Grafikon {
    constructor(selector) {
        this.ctx = $(selector).get(0);
        this.chart = null;
    }
    kirajzol(mennyisegek) {
        this.chart?.destroy();
        this.chart = new Chart(this.ctx, {
            type: 'doughnut',
            data: {
                labels: mennyisegek.map(adat => adat.tipus),
                datasets: [{
                    data: mennyisegek.map(adat => adat.mennyiseg),
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Havi mennyiségek megoszlása hulladék típusonként',
                        font: {size:10},
                    }
                }
            }
        });
    }
}

class PdfLink {
    constructor(selector) {
        this.link = $(selector);
    }
    frissit() {
        const [szolgid, ev, honap] = getSzures();
        const url = `${SITE_ROOT}pdf/?szolgid=${szolgid}&ev=${ev}&honap=${honap}`;
        this.link.attr('href', url);
        this.link.show();
    }
}

let naptar = grafikon = pdf_link = null;

document.addEventListener("DOMContentLoaded", () => {
    naptar = new Naptar('#naptar');
    grafikon = new Grafikon('#grafikon');
    pdf_link = new PdfLink('#pdf-link');
    addEventHandlers();
});

function addEventHandlers() {
    $('#szuro').on('click', 'button', async function (e) {
        const [szolgid, ev, honap] = getSzures();

        if (!(szolgid && ev && honap)) {
            return;
        }

        $(this).prop('disabled', true);
        const {napok, szallitasi_napok, igenyek, mennyisegek} = await getData(szolgid, ev, honap);
        naptar.kirajzol(napok, szallitasi_napok, igenyek);
        grafikon.kirajzol(mennyisegek);
        pdf_link.frissit();
        $(this).prop('disabled', false);
    });
}

async function getData(szolgid, ev, honap) {
    return await $.ajax({
        url: AJAX_URL,
        data: {
            szolgid: szolgid,
            ev: ev,
            honap: honap,
        },
    });
}

function getSzures() {
    return [
        $('#szolgid').val(),
        $('#ev').val(),
        $('#honap').val(),
    ];
}