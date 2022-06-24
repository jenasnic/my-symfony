import '../../styles/form/_form.scss';

import { bindAutoComplete } from './auto-complete';
import { bindDropZone } from './drop-zone';
import { bindInputMask, bindNumberInput } from './input-mask';
import { bindSelect } from './select';

const mapping = <{[key: string]: Function}>{
  '[data-auto-complete]': bindAutoComplete,
  '[data-improve-select]': bindSelect,
  '[data-mask-input]': bindInputMask,
  '[data-number-input]': bindNumberInput,
  '[data-drop-zone]': bindDropZone,
};

export const bindForm = (element?: HTMLElement) => {
  Object.entries(mapping).forEach(([selector, binder]) => {
    [...(element || document).querySelectorAll<HTMLElement>(selector)].forEach((element) => {
      binder(element)
    }
  )});
};

bindForm();
