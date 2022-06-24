import Uppy from '@uppy/core'
import DragDrop from '@uppy/drag-drop'
import ProgressBar from '@uppy/progress-bar'
import XHRUpload from '@uppy/xhr-upload'

import '@uppy/core/dist/style.css'
import '@uppy/drag-drop/dist/style.css'
import '@uppy/progress-bar/dist/style.css'

const onUploadSuccess = (element: HTMLElement) => (file, response) => {
    console.log(response, response.body.content)
    element.insertAdjacentHTML('beforeend', response.body.content);
    // console.log('remove_link', response.body.remove_link);
    // const url = response.uploadURL
    // const fileName = file.name
    //
    // const li = document.createElement('li')
    // const a = document.createElement('a')
    // a.href = url
    // a.target = '_blank'
    // a.appendChild(document.createTextNode(fileName))
    // li.appendChild(a)
    //
    // document.querySelector(elForUploadedFiles).appendChild(li)
}

export const bindDropZone = (element: HTMLElement) => {
    const maxCount = element.dataset.dropZoneMaxCount;
    if (!maxCount || !Number.isInteger(parseInt(maxCount))) {
        return
    }

    const areaTarget: HTMLElement|null = element.querySelector('.drop-zone_area');
    const progressTarget: HTMLElement|null = element.querySelector('.drop-zone_progress');
    const listTarget: HTMLElement|null = element.querySelector('.drop-zone_list');
    const endpoint = element.dataset.dropZone;

    if (!areaTarget || !progressTarget || !listTarget || !endpoint) {
        return;
    }

    const uppy = new Uppy({
        autoProceed: true,
        id: element.dataset.dropZoneId,
        restrictions: {
            maxFileSize: 10000,
            maxNumberOfFiles: parseInt(maxCount),
            allowedFileTypes: ['.jpg', '.jpeg', '.png', '.pdf'],
        }
    });

    uppy
        .use(DragDrop, { target: areaTarget })
        .use(ProgressBar, { target: progressTarget })
        .use(XHRUpload, { endpoint: endpoint, fieldName: 'file', })
        .on('upload-success', onUploadSuccess(listTarget))
    ;
}
