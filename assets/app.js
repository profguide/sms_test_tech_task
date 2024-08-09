"use strict"

import $ from 'jquery';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import './styles/app.css';

const storage = (function () {
  const answers = [];

  return {
    add(qId, values) {
      answers.push({qId, values})
    }, getAll() {
      return answers;
    }
  }
})();

const api = {
  loadFirst() {
    return axios.get('/api').then(response => {
      return response.data.question;
    });
  },
  loadNext(id) {
    return axios.get(`/api/next/${id}`).then(response => {
      return response.data.question ? response.data.question : null
    });
  },
  save(progress) {
    return axios({
      url: `/api/save`,
      method: 'post',
      data: progress
    }).then(response => {
      return response.data.id;
    });
  }
}

$(function () {
  const testWrapperTag = $('#test');

  // api.save([
  //   {qId: 1, values: [1]},
  //   {qId: 2, values: [1, 2]},
  //   {qId: 3, values: [1, 3]},
  //   {qId: 4, values: [1, 2]},
  //   {qId: 5, values: [1, 3]},
  //   {qId: 6, values: [1, 2]},
  //   {qId: 7, values: [1]},
  //   {qId: 8, values: [1]},
  //   {qId: 9, values: [1]},
  //   {qId: 10, values: [1]},
  // ])

  if (testWrapperTag.length) {
    api.loadFirst().then(question => {
      onFetchQuestion(question);
    });
  }

  function next(id) {
    api.loadNext(id).then(question => {
      if (question) {
        onFetchQuestion(question);
      } else {
        onQuestionsOver();
      }
    });
  }

  function onQuestionsOver() {
    api.save(storage.getAll()).then(function (id) {
      window.location.href = `/result/${id}`;
    });
  }

  function onButtonClick(qId, values) {
    storage.add(qId, values);
    next(qId);
  }

  function onFetchQuestion(data) {
    testWrapperTag.html('');

    const name = document.createElement('div')
    name.className = 'test__name';
    name.innerText = data.text;

    // options
    const options = document.createElement('ul');
    options.className = 'test__ul';
    for (let i = 0; i < data.options.length; i++) {
      const checkboxId = 'q-' + data.id + '-' + data.options[i].id;

      const checkbox = document.createElement('input');
      checkbox.className = 'test__checkbox';
      checkbox.id = checkboxId;
      checkbox.type = 'checkbox';
      checkbox.value = data.options[i].id;

      const label = document.createElement('label');
      label.setAttribute('for', checkboxId);
      label.innerText = data.options[i].text;

      const li = document.createElement('li');
      li.className = 'test__li';
      li.appendChild(checkbox);
      li.appendChild(label);
      options.appendChild(li);
    }

    const button = document.createElement('button')
    button.className = 'test__button btn btn-primary';
    button.innerText = 'Ответить';

    button.addEventListener('click', function (event) {
      event.preventDefault();
      const values = [];
      $(".test__checkbox:checked").map(function (l, o) {
        values.push(o.value);
      });
      if (values.length === 0) {
        alert('Нужно выбрать хотя бы одно значение.');
      } else {
        onButtonClick(data.id, values);
      }
    });

    const form = document.createElement('form');
    form.appendChild(name);
    form.appendChild(options);
    form.appendChild(button);

    testWrapperTag.append(form);
  }
});
