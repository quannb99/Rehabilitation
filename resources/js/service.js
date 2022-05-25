export const postModel = (model, data) =>
  axios.request({
    method: "POST",
    url: `/${model}`,
    data,
  });

export const getModel = (model, params) =>
  axios.request({
    url: `/${model}`,
    params,
  });

export const updateModel = (model, data, id) =>
  axios.request({
    url: `/${model}/${id}`,
    method: "PUT",
    data,
  });
export const deleteModel = (model, id, data) =>
  axios.request({
    url: `/${model}/${id}`,
    method: "DELETE",
    data,
  });
