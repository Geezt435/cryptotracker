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
                    {
                        data: 'creator'
                    },
                    {
                        data: 'pubDate',
                        render: function (data, type, row) {
                            const date = new Date(data);
                            const formattedDate = date.toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                            return formattedDate;
                        }
                    }
                ],
                order: [[0, 'asc']],
                paging: true,
                pageLength: 10
            });
        })
        .catch(error => console.error('Kesalahan / Error:', error));
});