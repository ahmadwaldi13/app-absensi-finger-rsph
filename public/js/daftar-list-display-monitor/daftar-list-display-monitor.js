$("select").on("change", function () {
    const parent_el = $(this).closest("tr")
    const link = parent_el.find('#link').attr('href')
    const url = new URL(link);
    url.searchParams.set('t', $(this).val())
    parent_el.find('#link').attr('href', url.href)
})