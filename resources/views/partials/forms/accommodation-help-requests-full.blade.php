<div class="card shadow">
    <div class="card-body">
        <h5 class="font-weight-600 text-primary mb-4">Rezervari</h5>
        <div class="row align-items-center mb-4">
            <div class="col">
                <h6 class="font-weight-600 mb-0">{{ __('Total Results') }}: <span id="totalResults"></span></h6>
            </div>
            <div class="col d-none d-sm-block">
                <nav aria-label="...">
                    <ul class="pagination justify-content-center mb-0"></ul>
                </nav>
            </div>
            <div class="col d-none d-sm-block">
                <div class="form-inline justify-content-end">
                    <div class="form-group">
                        <label class="mr-3">{{ __('Results per page') }}</label>
                        <select class="custom-select form-control form-control-sm resultsPerPage">
                            <option value="1">1</option>
                            <option value="15">15</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive shadow-sm mb-4">
            <table class="table table-striped w-100 mb-0">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('Refugee name') }}</th>
                    <th>{{ __('Help request') }}</th>
                    <th>{{ __('Number of people') }}</th>
                    <th>{{ __('Allocation date') }}</th>
                    <th>{{ __('Updated at') }}</th>
                    <th class="text-right">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                </tbody>
            </table>
        </div>
        <div class="row align-items-center mb-4 flex-column flex-sm-row text-center text-sm-left">
            <div class="col offset-sm-4 mb-4 mb-sm-0">
                <nav aria-label="...">
                    <ul class="pagination justify-content-center mb-0"></ul>
                </nav>
            </div>
            <div class="col">
                <div class="form-inline justify-content-center justify-content-sm-end">
                    <div class="form-group">
                        <label for="" class="mr-3">{{ __('Results per page') }}</label>
                        <select name="" id="" class="custom-select form-control form-control-sm resultsPerPage">
                            <option value="1">1</option>
                            <option value="15">15</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script type="text/javascript" src="{{ mix('js/table-data-renderer.js') }}"></script>
    <script>
        class AccommodationRenderer extends TableDataRenderer {
            renderTable(responseData) {
                this.emptyTable();

                $.each(responseData, function (key, value) {
                    let row = '<tr>\n' +
                        '    <td>' + value.name + '</td>\n' +
                        '    <td><a href="/{{ $area }}/help-request/' + value.id + '">#' + value.id + '</a></td>\n' +
                        '    <td>' + value.number_of_guest + '</td>\n' +
                        '    <td>' + value.created_at + '</td>\n' +
                        '    <td>' + value.updated_at + '</td>\n' +
                        '    <td class="text-right">\n' +
                        '        <a href="/admin/help-request/' + value.id + '#helpTypeCard{{ \App\HelpType::TYPE_ACCOMMODATION }}" class="btn btn-sm btn-info mb-2 mb-sm-0" >{{ __("More details") }}</a>\n' +
                        '    </td>\n' +
                        '</tr>';
                    $('#tableBody').append(row);
                });
            }
        }

        $(document).ready(function () {
            let pageState = {};
            pageState.page = 1;
            pageState.perPage = 15;

            if (undefined !== $.QueryString.page) {
                pageState.page = $.QueryString.page;
            }

            if (undefined !== $.QueryString.perPage && -1 !== $.inArray($.QueryString.perPage, ["1", "15", "50", "100"])) {
                pageState.perPage = $.QueryString.perPage;
            }

            $('.resultsPerPage').val(pageState.perPage);

            let renderer = new AccommodationRenderer('{{ route('ajax.accommodation-requests', [ 'id' => $accommodation->id ]) }}');
            renderer.renderData(pageState);

            $('.resultsPerPage').on('change', function () {
                $('.resultsPerPage').val(this.value);
                pageState.perPage = this.value;
                $.SetQueryStringParameter('perPage', pageState.perPage);
                pageState.page = 1;
                $.SetQueryStringParameter('page', pageState.page);

                renderer.renderData(pageState);
            });

            $('body').on('click', 'a.page-link', function (event) {
                event.preventDefault();
                pageState.page = $(this).data('page');
                $.SetQueryStringParameter('page', pageState.page);
                renderer.renderData(pageState);
            });
        });
    </script>
@endsection
