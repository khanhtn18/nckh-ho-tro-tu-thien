(function () {
    //polyfill for javascript forEach
    if (!Array.prototype.forEach) {
        Array.prototype.forEach = function (callback, thisArg) {

            var T, k;

            if (this == null) {
                throw new TypeError(' this is null or not defined');
            }
            var O = Object(this);
            var len = O.length >>> 0;
            if (typeof callback !== "function") {
                throw new TypeError(callback + ' is not a function');
            }
            if (arguments.length > 1) {
                T = thisArg;
            }
            k = 0;
            while (k < len) {

                var kValue;
                if (k in O) {
                    kValue = O[k];
                    callback.call(T, kValue, k, O);
                }
                k++;
            }
        };
    }

    Array.convertNodeList = function (list) {
        var array = new Array(list.length);
        for (var i = 0, n = list.length; i < n; i++)
            array[i] = list[i];
        return array;
    };

    var dataAttributeString = function (nodeName) {
        var string = nodeName.split('-');
        string.splice(0, 1);
        string.forEach(function (v, i) {
            if (i !== 0) {
                string[i] = v.charAt(0).toUpperCase() + v.slice(1);
            }
        });
        return string.join('');
    }

    //constructor for ajax handler
    var AjaxHandler = function () {
        var methods = {
            get: "GET",
            post: "POST"
        };
        var send = function (params) {
            var config = {
                method: methods.post,
                url: '',
                data: null,
                callback: function () {
                    return true;
                },
                errorCallback: function () {
                    return false;
                }
            }

            for (var key in params) {
                config[key] = params[key];
            }

            var query = '';

            if (config.data) {
                var queryData = [];
                for (var key in config.data) {
                    queryData.push(encodeURIComponent(key) + '=' + encodeURIComponent(config.data[key]));
                };
                query = queryData.join('&');
            }

            if (config.method === methods.get && query.length > 0) {
                var concat = '?';
                if (config.url.indexOf('?') >= 0) {
                    concat = '&';
                }
                config.url += concat + query;
                query = null;
            }

            var req = new XMLHttpRequest();
            if ('withCredentials' in req) {
                req.open(config.method, config.url);

            }
            else if (typeof XDomainRequest != 'undefined') {
                req = new XDomainRequest();
                req.open(config.method, config.url);
            }
            else {
                return false;
            }

            req.setRequestHeader('Content-type', 'application/json');
            req.setRequestHeader('Accept', '*/*');

            req.onreadystatechange = function () {
                if ((req.readyState == XMLHttpRequest.DONE || req.readyState === 4) && req.status == 200 && config.callback) {
                    var res = req.responseText;
                    try {
                        res = JSON.parse(req.responseText);
                    } catch (e) {
                        if (config.errorCallback) config.errorCallback(res);
                        res = null;
                    }
                    if (res != null && config.callback) config.callback(res);
                }
                else {
                    if (config.errorCallback) config.errorCallback(res);
                }
            }
            req.send(query);
        };

        var get = function (params) {
            params['method'] = methods.get;
            send(params);
        };

        var post = function (params) {
            params['method'] = methods.post;
            send(params);
        };

        return {
            get: get,
            post: post
        };
    };

    var $ajax = new AjaxHandler();

    //constructor for widget
    var TBWidget = function (elem) {
        var el,
			config = {
			    tbWidget: '',
			    widget: '',
			    k: '',
			    ajaxUrl: 'https://platform.talentbrew.com/api/v1/ExternalWidget'
			    //additional properties that may be set on module markup
			    //for search form: results, noResults
			    //for job list: showLocation, viewMore, viewMoreLink, showDate
			};

        var debounce = false;

        var widgetTypes = {
            search: "search",
            list: "list"
        };

        var classes = {
            listNoResults: 'tb-widget-list-no-results',
            listLocation: 'tb-widget-list-location',
            listCategory: 'tb-widget-list-category',
            listDate: 'tb-widget-list-date',
            searchResults: 'tb-widget-search-results',
            searchResultCount: 'tb-widget-search-result-count',
            searchNoResults: 'tb-widget-search-no-results'
        };

        var buildLinkList = function (arr, params) {
            var list = document.createElement('ul');
            arr.forEach(function (i) {
                var listItem = document.createElement('li');
                var link = document.createElement('a');
                link.href = i.jobDetailUrl || "#";
                link.innerHTML = i.title;
                listItem.appendChild(link);
                if (params && params.showCategory && i.category) {
                    var category = document.createElement('span');
                    category.className = classes.listCategory;
                    category.innerHTML = i.category;
                    listItem.appendChild(category);
                }
                if (params && params.showLocation && i.location) {
                    var location = document.createElement('span');
                    location.className = classes.listLocation;
                    location.innerHTML = i.location;
                    listItem.appendChild(location);
                }
                if (params && params.showDate && i.jobDetailsDate) {
                    var date = document.createElement('span');
                    date.className = classes.listDate;
                    date.innerHTML = i.jobDetailsDate;
                    listItem.appendChild(date);
                }
                list.appendChild(listItem);
            });
            return list;
        }

        var errorCallback = function () {
            debounce = false;
            return false;
        };

        var initList = function () {
            var listCallback = function (data) {
                if (data.length > 0) {
                    var list = buildLinkList(data, config);
                    el.insertBefore(list, el.lastElementChild);
                    if (config.viewMore) {
                        var viewmore = document.createElement('a');
                        viewmore.href = config.viewMoreLink || '#';
                        viewmore.text = config.viewMore;
                        el.insertBefore(viewmore, el.lastElementChild);
                    }
                    //remove fallback link
                    el.lastElementChild.remove();
                }
            };

            $ajax.get({
                url: config.ajaxUrl,
                data: {
                    tbWidget: config.tbWidget,
                    k: '',
                    widget: config.widget
                },
                callback: listCallback,
                errorCallback: errorCallback
            });
        };

        var initSearch = function () {
            var searchKeywordInput = null;

            for (var elem in el.childNodes) {
                if (typeof el.childNodes[elem].getAttribute == 'function' && el.childNodes[elem].getAttribute('name') === 'k') {
                    searchKeywordInput = el.childNodes[elem];
                    break;
                }
            }

            var emptyResults = function () {
                for (var elem in el.childNodes) {
                    if (el.childNodes[elem].className === classes.searchResults || el.childNodes[elem].className === classes.searchNoResults) {
                        el.removeChild(el.childNodes[elem]);
                        break;
                    }
                }
            }

            var searchCallback = function (data) {
                emptyResults();
                if (data.length === 0 && config.noResults) {
                    var noresults = document.createElement('p');
                    noresults.className = classes.searchNoResults;
                    noresults.setAttribute('tabindex', '0');
                    noresults.setAttribute('role', 'status');
                    el.appendChild(noresults);
                    noresults.innerHTML = config.noResults;
                    noresults.focus();
                }

                else {
                    var wrapper = document.createElement('div');
                    wrapper.className = classes.searchResults;
                    var list = buildLinkList(data, config);
                    wrapper.appendChild(list);
                    el.appendChild(wrapper);
                    if (config.results) {
                        var resultCount = document.createElement('span');
                        resultCount.className = classes.searchResultCount;
                        resultCount.setAttribute('tabindex', '0');
                        resultCount.setAttribute('role', 'status');
                        wrapper.insertBefore(resultCount, list);
                        resultCount.innerHTML = config.results.replace('[[RESULT_COUNT]]', data.length);
                        resultCount.focus();
                    }
                }

                debounce = false;
            };

            document.getElementById('tb-widget-search').addEventListener('keydown', function (e) {
                if (!e) { var e = window.event; }           
                if (e.keyCode == 13) {
                    document.getElementById('tb-search-widget-button').click();
                }
            }, false);

            document.getElementById('tb-search-widget-button').addEventListener('click', function (e) {
                e.preventDefault();

                var redirectToTBSite = this.parentNode.hasAttribute('data-redirect');
                var openNewTab = this.parentNode.hasAttribute('data-new-tab');
                if (redirectToTBSite || openNewTab) {
                    var searchValue = document.getElementById('tb-widget-search').value;
                    var redirectLink = this.parentNode.getAttribute('data-redirect-link') + '/' + searchValue;
                    if (redirectToTBSite) {
                        window.location = redirectLink;
                    }
                    else if (openNewTab) {
                        window.open(
                            redirectLink,
                            '_blank'
                        );
                    }
                }

                else {
                    if (!config.results) {
                        return true;
                    }
                    if (searchKeywordInput.value && !debounce) {
                        debounce = true;
                        $ajax.get({
                            url: config.ajaxUrl,

                            data: {
                                tbWidget: config.tbWidget,
                                k: searchKeywordInput.value,
                                widget: config.widget

                            },
                            callback: searchCallback,
                            errorCallback: errorCallback

                        });
                    }
                }
                return false;

            });

            searchKeywordInput.onkeydown = emptyResults;
            searchKeywordInput.onsearch = emptyResults;
        };

        var init = function (elem) {
            if (elem.attributes.length === 0) return false;
            el = elem;

            Array.convertNodeList(elem.attributes).forEach(function (a) {
                if (a.nodeName.indexOf('data-') >= 0) {
                    config[dataAttributeString(a.nodeName)] = a.Value || a.nodeValue;
                }
            });

            switch (config.tbWidget) {
                case (widgetTypes.list):
                    initList();
                    break;
                case (widgetTypes.search):
                    initSearch();
                    break;
                default:
                    return false;
                    break;
            }
        };
        init(elem);
    };

    var widgetNodes = document.querySelectorAll('[data-tb-widget]');
    if (widgetNodes.length === 0) {
        return false;
    }
    var widgets = Array.convertNodeList(widgetNodes);
    widgets.forEach(function (w) {
        TBWidget(w);
    });
})();