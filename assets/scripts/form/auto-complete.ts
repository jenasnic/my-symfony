import { bindSelect } from './select';

export const bindAutoComplete = (element: HTMLElement) => {
  const select = element.querySelector<HTMLElement>('select');
  if (!select) {
    return;
  }

  bindSelect(select, {
    ajax: {
      url: element.dataset.autoCompleteUrl,
      dataType: 'json',
      delay: 250,
      data: function (params) {
        const data = Object.assign({}, element.dataset);
        delete data.autoComplete;
        delete data.autoCompleteUrl;
        delete data.autoCompleteParameter;
        delete data.placeholder;
        if (element.dataset.autoCompleteParameter) {
          data[element.dataset.autoCompleteParameter] = params.term;
        }

        return data;
      },
      processResults: (data) => ({
          results: data
      }),
      cache: true
    },
    minimumInputLength: 1,
    placeholder: element.dataset.placeholder || '-',
  });
};
