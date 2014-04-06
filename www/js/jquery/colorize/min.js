jQuery.fn.colorize = function(q) {
    options = {altColor: "#eee", bgColor: "#fafafa", hoverColor: "#fce6a2", hoverClass: "", hiliteColor: "#fce6a2", hiliteClass: "", oneClick: false, hover: "row", click: "row", banColumns: [], banRows: [], banDataClick: false, ignoreHeaders: true, nested: false};
    jQuery.extend(options, q);
    var r = {addHoverClass: function() {
            this.origColor = this.style.backgroundColor;
            this.style.backgroundColor = "";
            jQuery(this).addClass(options.hoverClass)
        }, addBgHover: function() {
            this.origColor = this.style.backgroundColor;
            this.style.backgroundColor = options.hoverColor
        }, removeHoverClass: function() {
            jQuery(this).removeClass(options.hoverClass);
            this.style.backgroundColor = this.origColor
        }, removeBgHover: function() {
            this.style.backgroundColor = this.origColor
        }, checkHover: function() {
            if (c(this)) {
                return
            }
            if (!this.onfire) {
                this.hover()
            }
        }, checkHoverOut: function() {
            if (!this.onfire) {
                this.removeHover()
            }
        }, highlight: function() {
            return false; // edited by chenyongcai
            if (options.hiliteClass.length > 0 || options.hiliteColor != "none") {
                if (c(this)) {
                    return
                }
                this.onfire = true;
                if (options.hiliteClass.length > 0) {
                    this.style.backgroundColor = "";
                    jQuery(this).addClass(options.hiliteClass).removeClass(options.hoverClass)
                } else {
                    if (options.hiliteColor != "none") {
                        this.style.backgroundColor = options.hiliteColor;
                        if (options.hoverClass.length > 0) {
                            jQuery(this).removeClass(options.hoverClass)
                        }
                    }
                }
            }
        }, stopHighlight: function() {
            this.onfire = false;
            this.style.backgroundColor = (this.origColor) ? this.origColor : "";
            jQuery(this).removeClass(options.hiliteClass).removeClass(options.hoverClass)
        }};
    function o(u, s, v) {
        var t = w(u, s);
        jQuery.each(t, function(y, x) {
            v.call(x)
        });
        function w(z, y) {
            var x = [];
            for (var A = 0; A < z.length; A++) {
                if (z[A].cellIndex == y) {
                    x.push(z[A])
                }
            }
            return x
        }}
    function g(t, s, u) {
        o(t, s.cellIndex, u)
    }
    var j = {toggleColumnClick: function(s) {
            var t = (!this.onfire) ? r.highlight : r.stopHighlight;
            g(s, this, t)
        }, toggleRowClick: function(s) {
            row = jQuery(this).parent().get(0);
            if (!row.onfire) {
                r.highlight.call(row)
            } else {
                r.stopHighlight.call(row)
            }
        }, oneClick: function(s) {
            if (s != null) {
                if (this.isRepeatClick()) {
                    this.stopHilite();
                    this.cancel()
                } else {
                    this.stopHilite();
                    this.hilite()
                }
            } else {
                this.hilite()
            }
        }, oneColumnClick: function(s) {
            var t = this.cellIndex;
            function u() {
                return(s.clicked == t)
            }
            m.handleClick(this, s, t, u)
        }, oneRowClick: function(s) {
            var v = jQuery(this).parent().get(0);
            var t = v.rowIndex;
            function u() {
                return(s.rowClicked == t)
            }
            n.handleClick(this, s, v.rowIndex, u)
        }, oneColumnRowClick: function(t) {
            var u = this.cellIndex;
            var v = jQuery(this).parent().get(0);
            function w() {
                return(t.clicked == u && t.rowClicked == v.rowIndex)
            }
            function s() {
                return(t.rowClicked == v.rowIndex && this.cellIndex == t.clicked)
            }
            m.handleClick(this, t, u, w);
            n.handleClick(this, t, v.rowIndex, s)
        }};
    var m = {init: function(s, t, u) {
            this.cell = s;
            this.cells = t;
            this.indx = u
        }, handleClick: function(s, t, v, u) {
            this.init(s, t, v);
            this.isRepeatClick = u;
            j.oneClick.call(this, t.clicked)
        }, stopHilite: function() {
            o(this.cells, this.cells.clicked, r.stopHighlight)
        }, hilite: function() {
            g(this.cells, this.cell, r.highlight);
            this.cells.clicked = this.indx
        }, cancel: function() {
            this.cells.clicked = null
        }};
    var n = {init: function(s, t, u) {
            this.cell = s;
            this.cells = t;
            this.indx = u
        }, handleClick: function(s, t, v, u) {
            this.init(s, t, v);
            this.isRepeatClick = u;
            j.oneClick.call(this, t.rowClicked)
        }, stopHilite: function() {
            r.stopHighlight.call(j.tbl.rows[this.cells.rowClicked])
        }, hilite: function() {
            var s = jQuery(this.cell).parent().get(0);
            if (options.hover == "column") {
                r.addBgHover.call(s)
            }
            r.highlight.call(s);
            this.cells.rowClicked = this.indx
        }, cancel: function() {
            this.cells.rowClicked = null
        }};
    function i() {
        return(this.nodeName == "TD")
    }
    function f() {
        return(jQuery.inArray(this.cellIndex, options.banColumns) != -1)
    }
    function c(s) {
        if (options.banRows.length > 0) {
            var t = jQuery(s).parent().get(0);
            return jQuery.inArray(t.rowIndex, options.banRows) != -1
        } else {
            return false
        }
    }
    function p() {
        this.hover = k.hover;
        this.removeHover = k.removeHover
    }
    function d(s, t) {
        p.call(s);
        s.onmouseover = function() {
            if (f.call(this)) {
                return
            }
            g(t, this, r.checkHover)
        };
        s.onmouseout = function() {
            if (f.call(this)) {
                return
            }
            g(t, this, r.checkHoverOut)
        }
    }
    function e(s, t) {
        row = jQuery(s).parent().get(0);
        p.call(row);
        row.onmouseover = r.checkHover;
        row.onmouseout = r.checkHoverOut
    }
    function a(s, t) {
        e(s, t);
        d(s, t)
    }
    var k = {setHover: function() {
            if (options.hoverClass.length > 0) {
                this.hover = r.addHoverClass;
                this.removeHover = r.removeHoverClass
            } else {
                this.hover = r.addBgHover;
                this.removeHover = r.removeBgHover
            }
        }, getRowClick: function() {
            if (options.oneClick) {
                return j.oneRowClick
            } else {
                return j.toggleRowClick
            }
        }, getColumnClick: function() {
            if (options.oneClick) {
                return j.oneColumnClick
            } else {
                return j.toggleColumnClick
            }
        }, getRowColClick: function() {
            return j.oneColumnRowClick
        }};
    var b = {clickFunc: h(), handleHoverEvents: l()};
    function l() {
        if (options.hover == "column") {
            return d
        } else {
            if (options.hover == "cross") {
                return a
            } else {
                return e
            }
        }
    }
    function h() {
        if (options.click == "column") {
            return k.getColumnClick()
        } else {
            if (options.click == "cross") {
                return k.getRowColClick()
            } else {
                return k.getRowClick()
            }
        }
    }
    return this.each(function() {
        if (options.altColor != "none") {
            var t, u;
            t = u = (options.ignoreHeaders) ? "tr:has(td)" : "tr";
            if (options.nested) {
                t += ":nth-child(odd)";
                u += ":nth-child(even)"
            } else {
                t += ":odd";
                u += ":even"
            }
            jQuery(this).find(u).css("background", options.bgColor);
            jQuery(this).find(t).css("background", options.altColor)
        }
        if (options.columns) {
            alert("The 'columns' option is deprecated.\nPlease use the 'click' and 'hover' options instead.")
        }
        if (jQuery(this).find("thead tr:last th").length > 0) {
            var s = jQuery(this).find("td, thead tr:last th")
        } else {
            var s = jQuery(this).find("td,th")
        }
        s.clicked = null;
        if (jQuery.inArray("last", options.banColumns) != -1) {
            if (this.rows.length > 0) {
                options.banColumns.push(this.rows[0].cells.length - 1)
            }
        }
        k.setHover();
        j.tbl = this;
        jQuery.each(s, function(w, v) {
            b.handleHoverEvents(this, s);
            $(this).bind("click", function(x) {
                if (f.call(this)) {
                    return
                }
                if (options.banDataClick && i.call(this)) {
                    return
                }
                b.clickFunc.call(this, s)
            })
        })
    })
};
