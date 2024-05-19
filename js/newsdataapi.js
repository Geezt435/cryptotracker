document.addEventListener('DOMContentLoaded', function () {
    const baseUrl = "https://newsdata.io/api/1/latest?apikey=pub_4446039d7a410b51eb639632bffca07f72581&q=cryptocurrency&language=en";

    fetch(baseUrl)
        .then(response => response.json())
        .then(data => {
            const coinTable = $('#cryptoNews').DataTable({
                data: data.results,
                columns: [
                    {
                        data: null,
                        render: function (data, type, row) {
                            return '<a href="' + data.link + '">' + data.title + '</a>';
                        }
                    },
                    {
                        data: "description",
                        render: function (data, type, row) {
                            if (data != null && data != "") {
                                return data;
                            } else {
                                return 'No description available';
                            }
                        }
                    },
                    { data: 'pubDate' }],
                order: [[0, 'asc']],
                paging: true,
                pageLength: 10
            });
        })
        .catch(error => console.error('Kesalahan / Error:', error));
});