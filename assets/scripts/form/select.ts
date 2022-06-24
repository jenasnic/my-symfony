import 'select2';
import 'select2/dist/js/i18n/fr';
import 'select2/dist/css/select2.min.css';
import '../../styles/form/_select.scss';

export const bindSelect = (select: HTMLElement, options = {}) => {
  const mdcType = select.parentElement && select.parentElement.dataset.hasOwnProperty('selectType')
    ? select.parentElement.dataset.selectType
    : 'filled'
  ;

  const defaultOptions = {
    language: 'fr',
    theme: 'material',
    dropdownCssClass: `select2-dropdown--${mdcType}`,
    ...(select.dataset.tags ? { tags: true } : {}),
    placeholder: select.dataset.placeholder || false,
  };
  options = {...defaultOptions, ...options};

  $(select).select2(options);
  $(select).on('select2:open', () => {
    const searchField = [...document.querySelectorAll<HTMLElement>('.select2-dropdown .select2-search__field')].pop();
    if (!searchField) {
      return;
    }

    searchField.focus();
  });
  $(select).on('select2:select', e => {
    const target = e.target;
    if (!target || !(target instanceof HTMLSelectElement)) {
      return;
    }
    const hiddenInputId = target.dataset.bindCompletableChoice;

    if (hiddenInputId) {
      const selectedData = e.params.data.id;
      const hiddenInput: HTMLInputElement|null = hiddenInputId ? document.querySelector(`input#${hiddenInputId}`) : null;

      if (hiddenInput) {
        hiddenInput.value = selectedData;
      }
    }
  });
};
