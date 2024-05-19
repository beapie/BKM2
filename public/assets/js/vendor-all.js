

 "use strict";
 !(function (e, t) {
	 "object" == typeof exports && "undefined" != typeof module ? t(exports) : "function" == typeof define && define.amd ? define(["exports"], t) : t(((e = e || self).Popper = {}));
 })(this, function (e) {
	 function t(e) {
		 return { width: (e = e.getBoundingClientRect()).width, height: e.height, top: e.top, right: e.right, bottom: e.bottom, left: e.left, x: e.left, y: e.top };
	 }
	 function n(e) {
		 return "[object Window]" !== e.toString() ? ((e = e.ownerDocument) && e.defaultView) || window : e;
	 }
	 function r(e) {
		 return { scrollLeft: (e = n(e)).pageXOffset, scrollTop: e.pageYOffset };
	 }
	 function o(e) {
		 return e instanceof n(e).Element || e instanceof Element;
	 }
	 function i(e) {
		 return e instanceof n(e).HTMLElement || e instanceof HTMLElement;
	 }
	 function a(e) {
		 return e ? (e.nodeName || "").toLowerCase() : null;
	 }
	 function s(e) {
		 return ((o(e) ? e.ownerDocument : e.document) || window.document).documentElement;
	 }
	 function f(e) {
		 return t(s(e)).left + r(e).scrollLeft;
	 }
	 function c(e) {
		 return n(e).getComputedStyle(e);
	 }
	 function p(e) {
		 return (e = c(e)), /auto|scroll|overlay|hidden/.test(e.overflow + e.overflowY + e.overflowX);
	 }
	 function l(e, o, c) {
		 void 0 === c && (c = !1);
		 var l = s(o);
		 e = t(e);
		 var u = i(o),
			 d = { scrollLeft: 0, scrollTop: 0 },
			 m = { x: 0, y: 0 };
		 return (
			 (u || (!u && !c)) && (("body" !== a(o) || p(l)) && (d = o !== n(o) && i(o) ? { scrollLeft: o.scrollLeft, scrollTop: o.scrollTop } : r(o)), i(o) ? (((m = t(o)).x += o.clientLeft), (m.y += o.clientTop)) : l && (m.x = f(l))),
			 { x: e.left + d.scrollLeft - m.x, y: e.top + d.scrollTop - m.y, width: e.width, height: e.height }
		 );
	 }
	 function u(e) {
		 return { x: e.offsetLeft, y: e.offsetTop, width: e.offsetWidth, height: e.offsetHeight };
	 }
	 function d(e) {
		 return "html" === a(e) ? e : e.assignedSlot || e.parentNode || e.host || s(e);
	 }
	 function m(e, t) {
		 void 0 === t && (t = []);
		 var r = (function e(t) {
			 return 0 <= ["html", "body", "#document"].indexOf(a(t)) ? t.ownerDocument.body : i(t) && p(t) ? t : e(d(t));
		 })(e);
		 e = "body" === a(r);
		 var o = n(r);
		 return (r = e ? [o].concat(o.visualViewport || [], p(r) ? r : []) : r), (t = t.concat(r)), e ? t : t.concat(m(d(r)));
	 }
	 function h(e) {
		 if (!i(e) || "fixed" === c(e).position) return null;
		 if ((e = e.offsetParent)) {
			 var t = s(e);
			 if ("body" === a(e) && "static" === c(e).position && "static" !== c(t).position) return t;
		 }
		 return e;
	 }
	 function g(e) {
		 for (var t = n(e), r = h(e); r && 0 <= ["table", "td", "th"].indexOf(a(r)) && "static" === c(r).position; ) r = h(r);
		 if (r && "body" === a(r) && "static" === c(r).position) return t;
		 if (!r)
			 e: {
				 for (e = d(e); i(e) && 0 > ["html", "body"].indexOf(a(e)); ) {
					 if ("none" !== (r = c(e)).transform || "none" !== r.perspective || (r.willChange && "auto" !== r.willChange)) {
						 r = e;
						 break e;
					 }
					 e = e.parentNode;
				 }
				 r = null;
			 }
		 return r || t;
	 }
	 function v(e) {
		 var t = new Map(),
			 n = new Set(),
			 r = [];
		 return (
			 e.forEach(function (e) {
				 t.set(e.name, e);
			 }),
			 e.forEach(function (e) {
				 n.has(e.name) ||
					 (function e(o) {
						 n.add(o.name),
							 [].concat(o.requires || [], o.requiresIfExists || []).forEach(function (r) {
								 n.has(r) || ((r = t.get(r)) && e(r));
							 }),
							 r.push(o);
					 })(e);
			 }),
			 r
		 );
	 }
	 function b(e) {
		 var t;
		 return function () {
			 return (
				 t ||
					 (t = new Promise(function (n) {
						 Promise.resolve().then(function () {
							 (t = void 0), n(e());
						 });
					 })),
				 t
			 );
		 };
	 }
	 function y(e) {
		 return e.split("-")[0];
	 }
	 function O(e, t) {
		 var r,
			 o = t.getRootNode && t.getRootNode();
		 if (e.contains(t)) return !0;
		 if (((r = o) && (r = o instanceof (r = n(o).ShadowRoot) || o instanceof ShadowRoot), r))
			 do {
				 if (t && e.isSameNode(t)) return !0;
				 t = t.parentNode || t.host;
			 } while (t);
		 return !1;
	 }
	 function w(e) {
		 return Object.assign(Object.assign({}, e), {}, { left: e.x, top: e.y, right: e.x + e.width, bottom: e.y + e.height });
	 }
	 function x(e, o) {
		 if ("viewport" === o) {
			 o = n(e);
			 var a = s(e);
			 o = o.visualViewport;
			 var p = a.clientWidth;
			 a = a.clientHeight;
			 var l = 0,
				 u = 0;
			 o && ((p = o.width), (a = o.height), /^((?!chrome|android).)*safari/i.test(navigator.userAgent) || ((l = o.offsetLeft), (u = o.offsetTop))), (e = w((e = { width: p, height: a, x: l + f(e), y: u })));
		 } else i(o) ? (((e = t(o)).top += o.clientTop), (e.left += o.clientLeft), (e.bottom = e.top + o.clientHeight), (e.right = e.left + o.clientWidth), (e.width = o.clientWidth), (e.height = o.clientHeight), (e.x = e.left), (e.y = e.top)) : ((u = s(e)), (e = s(u)), (l = r(u)), (o = u.ownerDocument.body), (p = Math.max(e.scrollWidth, e.clientWidth, o ? o.scrollWidth : 0, o ? o.clientWidth : 0)), (a = Math.max(e.scrollHeight, e.clientHeight, o ? o.scrollHeight : 0, o ? o.clientHeight : 0)), (u = -l.scrollLeft + f(u)), (l = -l.scrollTop), "rtl" === c(o || e).direction && (u += Math.max(e.clientWidth, o ? o.clientWidth : 0) - p), (e = w({ width: p, height: a, x: u, y: l })));
		 return e;
	 }
	 function j(e, t, n) {
		 return (
			 (t =
				 "clippingParents" === t
					 ? (function (e) {
						   var t = m(d(e)),
							   n = 0 <= ["absolute", "fixed"].indexOf(c(e).position) && i(e) ? g(e) : e;
						   return o(n)
							   ? t.filter(function (e) {
									 return o(e) && O(e, n) && "body" !== a(e);
								 })
							   : [];
					   })(e)
					 : [].concat(t)),
			 ((n = (n = [].concat(t, [n])).reduce(function (t, n) {
				 return (n = x(e, n)), (t.top = Math.max(n.top, t.top)), (t.right = Math.min(n.right, t.right)), (t.bottom = Math.min(n.bottom, t.bottom)), (t.left = Math.max(n.left, t.left)), t;
			 }, x(e, n[0]))).width = n.right - n.left),
			 (n.height = n.bottom - n.top),
			 (n.x = n.left),
			 (n.y = n.top),
			 n
		 );
	 }
	 function M(e) {
		 return 0 <= ["top", "bottom"].indexOf(e) ? "x" : "y";
	 }
	 function E(e) {
		 var t = e.reference,
			 n = e.element,
			 r = (e = e.placement) ? y(e) : null;
		 e = e ? e.split("-")[1] : null;
		 var o = t.x + t.width / 2 - n.width / 2,
			 i = t.y + t.height / 2 - n.height / 2;
		 switch (r) {
			 case "top":
				 o = { x: o, y: t.y - n.height };
				 break;
			 case "bottom":
				 o = { x: o, y: t.y + t.height };
				 break;
			 case "right":
				 o = { x: t.x + t.width, y: i };
				 break;
			 case "left":
				 o = { x: t.x - n.width, y: i };
				 break;
			 default:
				 o = { x: t.x, y: t.y };
		 }
		 if (null != (r = r ? M(r) : null))
			 switch (((i = "y" === r ? "height" : "width"), e)) {
				 case "start":
					 o[r] = Math.floor(o[r]) - Math.floor(t[i] / 2 - n[i] / 2);
					 break;
				 case "end":
					 o[r] = Math.floor(o[r]) + Math.ceil(t[i] / 2 - n[i] / 2);
			 }
		 return o;
	 }
	 function D(e) {
		 return Object.assign(Object.assign({}, { top: 0, right: 0, bottom: 0, left: 0 }), e);
	 }
	 function P(e, t) {
		 return t.reduce(function (t, n) {
			 return (t[n] = e), t;
		 }, {});
	 }
	 function L(e, n) {
		 void 0 === n && (n = {});
		 var r = n;
		 n = void 0 === (n = r.placement) ? e.placement : n;
		 var i = r.boundary,
			 a = void 0 === i ? "clippingParents" : i,
			 f = void 0 === (i = r.rootBoundary) ? "viewport" : i;
		 i = void 0 === (i = r.elementContext) ? "popper" : i;
		 var c = r.altBoundary,
			 p = void 0 !== c && c;
		 r = D("number" != typeof (r = void 0 === (r = r.padding) ? 0 : r) ? r : P(r, T));
		 var l = e.elements.reference;
		 (c = e.rects.popper),
			 (a = j(o((p = e.elements[p ? ("popper" === i ? "reference" : "popper") : i])) ? p : p.contextElement || s(e.elements.popper), a, f)),
			 (p = E({ reference: (f = t(l)), element: c, strategy: "absolute", placement: n })),
			 (c = w(Object.assign(Object.assign({}, c), p))),
			 (f = "popper" === i ? c : f);
		 var u = { top: a.top - f.top + r.top, bottom: f.bottom - a.bottom + r.bottom, left: a.left - f.left + r.left, right: f.right - a.right + r.right };
		 if (((e = e.modifiersData.offset), "popper" === i && e)) {
			 var d = e[n];
			 Object.keys(u).forEach(function (e) {
				 var t = 0 <= ["right", "bottom"].indexOf(e) ? 1 : -1,
					 n = 0 <= ["top", "bottom"].indexOf(e) ? "y" : "x";
				 u[e] += d[n] * t;
			 });
		 }
		 return u;
	 }
	 function k() {
		 for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n];
		 return !t.some(function (e) {
			 return !(e && "function" == typeof e.getBoundingClientRect);
		 });
	 }
	 function B(e) {
		 void 0 === e && (e = {});
		 var t = e.defaultModifiers,
			 n = void 0 === t ? [] : t,
			 r = void 0 === (e = e.defaultOptions) ? V : e;
		 return function (e, t, i) {
			 function a() {
				 f.forEach(function (e) {
					 return e();
				 }),
					 (f = []);
			 }
			 void 0 === i && (i = r);
			 var s = { placement: "bottom", orderedModifiers: [], options: Object.assign(Object.assign({}, V), r), modifiersData: {}, elements: { reference: e, popper: t }, attributes: {}, styles: {} },
				 f = [],
				 c = !1,
				 p = {
					 state: s,
					 setOptions: function (i) {
						 return (
							 a(),
							 (s.options = Object.assign(Object.assign(Object.assign({}, r), s.options), i)),
							 (s.scrollParents = { reference: o(e) ? m(e) : e.contextElement ? m(e.contextElement) : [], popper: m(t) }),
							 (i = (function (e) {
								 var t = v(e);
								 return N.reduce(function (e, n) {
									 return e.concat(
										 t.filter(function (e) {
											 return e.phase === n;
										 })
									 );
								 }, []);
							 })(
								 (function (e) {
									 var t = e.reduce(function (e, t) {
										 var n = e[t.name];
										 return (
											 (e[t.name] = n
												 ? Object.assign(Object.assign(Object.assign({}, n), t), {}, { options: Object.assign(Object.assign({}, n.options), t.options), data: Object.assign(Object.assign({}, n.data), t.data) })
												 : t),
											 e
										 );
									 }, {});
									 return Object.keys(t).map(function (e) {
										 return t[e];
									 });
								 })([].concat(n, s.options.modifiers))
							 )),
							 (s.orderedModifiers = i.filter(function (e) {
								 return e.enabled;
							 })),
							 s.orderedModifiers.forEach(function (e) {
								 var t = e.name,
									 n = e.options;
								 (n = void 0 === n ? {} : n), "function" == typeof (e = e.effect) && ((t = e({ state: s, name: t, instance: p, options: n })), f.push(t || function () {}));
							 }),
							 p.update()
						 );
					 },
					 forceUpdate: function () {
						 if (!c) {
							 var e = s.elements,
								 t = e.reference;
							 if (k(t, (e = e.popper)))
								 for (
									 s.rects = { reference: l(t, g(e), "fixed" === s.options.strategy), popper: u(e) },
										 s.reset = !1,
										 s.placement = s.options.placement,
										 s.orderedModifiers.forEach(function (e) {
											 return (s.modifiersData[e.name] = Object.assign({}, e.data));
										 }),
										 t = 0;
									 t < s.orderedModifiers.length;
									 t++
								 )
									 if (!0 === s.reset) (s.reset = !1), (t = -1);
									 else {
										 var n = s.orderedModifiers[t];
										 e = n.fn;
										 var r = n.options;
										 (r = void 0 === r ? {} : r), (n = n.name), "function" == typeof e && (s = e({ state: s, options: r, name: n, instance: p }) || s);
									 }
						 }
					 },
					 update: b(function () {
						 return new Promise(function (e) {
							 p.forceUpdate(), e(s);
						 });
					 }),
					 destroy: function () {
						 a(), (c = !0);
					 },
				 };
			 return k(e, t)
				 ? (p.setOptions(i).then(function (e) {
					   !c && i.onFirstUpdate && i.onFirstUpdate(e);
				   }),
				   p)
				 : p;
		 };
	 }
	 function W(e) {
		 var t,
			 r = e.popper,
			 o = e.popperRect,
			 i = e.placement,
			 a = e.offsets,
			 f = e.position,
			 c = e.gpuAcceleration,
			 p = e.adaptive,
			 l = window.devicePixelRatio || 1;
		 (e = Math.round(a.x * l) / l || 0), (l = Math.round(a.y * l) / l || 0);
		 var u = a.hasOwnProperty("x");
		 a = a.hasOwnProperty("y");
		 var d,
			 m = "left",
			 h = "top",
			 v = window;
		 if (p) {
			 var b = g(r);
			 b === n(r) && (b = s(r)), "top" === i && ((h = "bottom"), (l -= b.clientHeight - o.height), (l *= c ? 1 : -1)), "left" === i && ((m = "right"), (e -= b.clientWidth - o.width), (e *= c ? 1 : -1));
		 }
		 return (
			 (r = Object.assign({ position: f }, p && z)),
			 c
				 ? Object.assign(
					   Object.assign({}, r),
					   {},
					   (((d = {})[h] = a ? "0" : ""), (d[m] = u ? "0" : ""), (d.transform = 2 > (v.devicePixelRatio || 1) ? "translate(" + e + "px, " + l + "px)" : "translate3d(" + e + "px, " + l + "px, 0)"), d)
				   )
				 : Object.assign(Object.assign({}, r), {}, (((t = {})[h] = a ? l + "px" : ""), (t[m] = u ? e + "px" : ""), (t.transform = ""), t))
		 );
	 }
	 function A(e) {
		 return e.replace(/left|right|bottom|top/g, function (e) {
			 return G[e];
		 });
	 }
	 function H(e) {
		 return e.replace(/start|end/g, function (e) {
			 return J[e];
		 });
	 }
	 function R(e, t, n) {
		 return void 0 === n && (n = { x: 0, y: 0 }), { top: e.top - t.height - n.y, right: e.right - t.width + n.x, bottom: e.bottom - t.height + n.y, left: e.left - t.width - n.x };
	 }
	 function S(e) {
		 return ["top", "right", "bottom", "left"].some(function (t) {
			 return 0 <= e[t];
		 });
	 }
	 var T = ["top", "bottom", "right", "left"],
		 q = T.reduce(function (e, t) {
			 return e.concat([t + "-start", t + "-end"]);
		 }, []),
		 C = [].concat(T, ["auto"]).reduce(function (e, t) {
			 return e.concat([t, t + "-start", t + "-end"]);
		 }, []),
		 N = "beforeRead read afterRead beforeMain main afterMain beforeWrite write afterWrite".split(" "),
		 V = { placement: "bottom", modifiers: [], strategy: "absolute" },
		 I = { passive: !0 },
		 _ = {
			 name: "eventListeners",
			 enabled: !0,
			 phase: "write",
			 fn: function () {},
			 effect: function (e) {
				 var t = e.state,
					 r = e.instance,
					 o = (e = e.options).scroll,
					 i = void 0 === o || o,
					 a = void 0 === (e = e.resize) || e,
					 s = n(t.elements.popper),
					 f = [].concat(t.scrollParents.reference, t.scrollParents.popper);
				 return (
					 i &&
						 f.forEach(function (e) {
							 e.addEventListener("scroll", r.update, I);
						 }),
					 a && s.addEventListener("resize", r.update, I),
					 function () {
						 i &&
							 f.forEach(function (e) {
								 e.removeEventListener("scroll", r.update, I);
							 }),
							 a && s.removeEventListener("resize", r.update, I);
					 }
				 );
			 },
			 data: {},
		 },
		 U = {
			 name: "popperOffsets",
			 enabled: !0,
			 phase: "read",
			 fn: function (e) {
				 var t = e.state;
				 t.modifiersData[e.name] = E({ reference: t.rects.reference, element: t.rects.popper, strategy: "absolute", placement: t.placement });
			 },
			 data: {},
		 },
		 z = { top: "auto", right: "auto", bottom: "auto", left: "auto" },
		 F = {
			 name: "computeStyles",
			 enabled: !0,
			 phase: "beforeWrite",
			 fn: function (e) {
				 var t = e.state,
					 n = e.options;
				 (e = void 0 === (e = n.gpuAcceleration) || e),
					 (n = void 0 === (n = n.adaptive) || n),
					 (e = { placement: y(t.placement), popper: t.elements.popper, popperRect: t.rects.popper, gpuAcceleration: e }),
					 null != t.modifiersData.popperOffsets &&
						 (t.styles.popper = Object.assign(Object.assign({}, t.styles.popper), W(Object.assign(Object.assign({}, e), {}, { offsets: t.modifiersData.popperOffsets, position: t.options.strategy, adaptive: n })))),
					 null != t.modifiersData.arrow && (t.styles.arrow = Object.assign(Object.assign({}, t.styles.arrow), W(Object.assign(Object.assign({}, e), {}, { offsets: t.modifiersData.arrow, position: "absolute", adaptive: !1 })))),
					 (t.attributes.popper = Object.assign(Object.assign({}, t.attributes.popper), {}, { "data-popper-placement": t.placement }));
			 },
			 data: {},
		 },
		 X = {
			 name: "applyStyles",
			 enabled: !0,
			 phase: "write",
			 fn: function (e) {
				 var t = e.state;
				 Object.keys(t.elements).forEach(function (e) {
					 var n = t.styles[e] || {},
						 r = t.attributes[e] || {},
						 o = t.elements[e];
					 i(o) &&
						 a(o) &&
						 (Object.assign(o.style, n),
						 Object.keys(r).forEach(function (e) {
							 var t = r[e];
							 !1 === t ? o.removeAttribute(e) : o.setAttribute(e, !0 === t ? "" : t);
						 }));
				 });
			 },
			 effect: function (e) {
				 var t = e.state,
					 n = { popper: { position: t.options.strategy, left: "0", top: "0", margin: "0" }, arrow: { position: "absolute" }, reference: {} };
				 return (
					 Object.assign(t.elements.popper.style, n.popper),
					 t.elements.arrow && Object.assign(t.elements.arrow.style, n.arrow),
					 function () {
						 Object.keys(t.elements).forEach(function (e) {
							 var r = t.elements[e],
								 o = t.attributes[e] || {};
							 (e = Object.keys(t.styles.hasOwnProperty(e) ? t.styles[e] : n[e]).reduce(function (e, t) {
								 return (e[t] = ""), e;
							 }, {})),
								 i(r) &&
									 a(r) &&
									 (Object.assign(r.style, e),
									 Object.keys(o).forEach(function (e) {
										 r.removeAttribute(e);
									 }));
						 });
					 }
				 );
			 },
			 requires: ["computeStyles"],
		 },
		 Y = {
			 name: "offset",
			 enabled: !0,
			 phase: "main",
			 requires: ["popperOffsets"],
			 fn: function (e) {
				 var t = e.state,
					 n = e.name,
					 r = void 0 === (e = e.options.offset) ? [0, 0] : e,
					 o = (e = C.reduce(function (e, n) {
						 var o = t.rects,
							 i = y(n),
							 a = 0 <= ["left", "top"].indexOf(i) ? -1 : 1,
							 s = "function" == typeof r ? r(Object.assign(Object.assign({}, o), {}, { placement: n })) : r;
						 return (o = (o = s[0]) || 0), (s = ((s = s[1]) || 0) * a), (i = 0 <= ["left", "right"].indexOf(i) ? { x: s, y: o } : { x: o, y: s }), (e[n] = i), e;
					 }, {}))[t.placement],
					 i = o.x;
				 (o = o.y), null != t.modifiersData.popperOffsets && ((t.modifiersData.popperOffsets.x += i), (t.modifiersData.popperOffsets.y += o)), (t.modifiersData[n] = e);
			 },
		 },
		 G = { left: "right", right: "left", bottom: "top", top: "bottom" },
		 J = { start: "end", end: "start" },
		 K = {
			 name: "flip",
			 enabled: !0,
			 phase: "main",
			 fn: function (e) {
				 var t = e.state,
					 n = e.options;
				 if (((e = e.name), !t.modifiersData[e]._skip)) {
					 var r = n.mainAxis;
					 r = void 0 === r || r;
					 var o = n.altAxis;
					 o = void 0 === o || o;
					 var i = n.fallbackPlacements,
						 a = n.padding,
						 s = n.boundary,
						 f = n.rootBoundary,
						 c = n.altBoundary,
						 p = n.flipVariations,
						 l = void 0 === p || p,
						 u = n.allowedAutoPlacements;
					 (p = y((n = t.options.placement))),
						 (i =
							 i ||
							 (p !== n && l
								 ? (function (e) {
									   if ("auto" === y(e)) return [];
									   var t = A(e);
									   return [H(e), t, H(t)];
								   })(n)
								 : [A(n)]));
					 var d = [n].concat(i).reduce(function (e, n) {
						 return e.concat(
							 "auto" === y(n)
								 ? (function (e, t) {
									   void 0 === t && (t = {});
									   var n = t.boundary,
										   r = t.rootBoundary,
										   o = t.padding,
										   i = t.flipVariations,
										   a = t.allowedAutoPlacements,
										   s = void 0 === a ? C : a,
										   f = t.placement.split("-")[1];
									   0 ===
										   (i = (t = f
											   ? i
												   ? q
												   : q.filter(function (e) {
														 return e.split("-")[1] === f;
													 })
											   : T).filter(function (e) {
											   return 0 <= s.indexOf(e);
										   })).length && (i = t);
									   var c = i.reduce(function (t, i) {
										   return (t[i] = L(e, { placement: i, boundary: n, rootBoundary: r, padding: o })[y(i)]), t;
									   }, {});
									   return Object.keys(c).sort(function (e, t) {
										   return c[e] - c[t];
									   });
								   })(t, { placement: n, boundary: s, rootBoundary: f, padding: a, flipVariations: l, allowedAutoPlacements: u })
								 : n
						 );
					 }, []);
					 (n = t.rects.reference), (i = t.rects.popper);
					 var m = new Map();
					 p = !0;
					 for (var h = d[0], g = 0; g < d.length; g++) {
						 var v = d[g],
							 b = y(v),
							 O = "start" === v.split("-")[1],
							 w = 0 <= ["top", "bottom"].indexOf(b),
							 x = w ? "width" : "height",
							 j = L(t, { placement: v, boundary: s, rootBoundary: f, altBoundary: c, padding: a });
						 if (
							 ((O = w ? (O ? "right" : "left") : O ? "bottom" : "top"),
							 n[x] > i[x] && (O = A(O)),
							 (x = A(O)),
							 (w = []),
							 r && w.push(0 >= j[b]),
							 o && w.push(0 >= j[O], 0 >= j[x]),
							 w.every(function (e) {
								 return e;
							 }))
						 ) {
							 (h = v), (p = !1);
							 break;
						 }
						 m.set(v, w);
					 }
					 if (p)
						 for (
							 r = function (e) {
								 var t = d.find(function (t) {
									 if ((t = m.get(t)))
										 return t.slice(0, e).every(function (e) {
											 return e;
										 });
								 });
								 if (t) return (h = t), "break";
							 },
								 o = l ? 3 : 1;
							 0 < o && "break" !== r(o);
							 o--
						 );
					 t.placement !== h && ((t.modifiersData[e]._skip = !0), (t.placement = h), (t.reset = !0));
				 }
			 },
			 requiresIfExists: ["offset"],
			 data: { _skip: !1 },
		 },
		 Q = {
			 name: "preventOverflow",
			 enabled: !0,
			 phase: "main",
			 fn: function (e) {
				 var t = e.state,
					 n = e.options;
				 e = e.name;
				 var r = n.mainAxis,
					 o = void 0 === r || r;
				 r = void 0 !== (r = n.altAxis) && r;
				 var i = n.tether;
				 i = void 0 === i || i;
				 var a = n.tetherOffset,
					 s = void 0 === a ? 0 : a;
				 (n = L(t, { boundary: n.boundary, rootBoundary: n.rootBoundary, padding: n.padding, altBoundary: n.altBoundary })), (a = y(t.placement));
				 var f = t.placement.split("-")[1],
					 c = !f,
					 p = M(a);
				 a = "x" === p ? "y" : "x";
				 var l = t.modifiersData.popperOffsets,
					 d = t.rects.reference,
					 m = t.rects.popper,
					 h = "function" == typeof s ? s(Object.assign(Object.assign({}, t.rects), {}, { placement: t.placement })) : s;
				 if (((s = { x: 0, y: 0 }), l)) {
					 if (o) {
						 var v = "y" === p ? "top" : "left",
							 b = "y" === p ? "bottom" : "right",
							 O = "y" === p ? "height" : "width";
						 o = l[p];
						 var w = l[p] + n[v],
							 x = l[p] - n[b],
							 j = i ? -m[O] / 2 : 0,
							 E = "start" === f ? d[O] : m[O];
						 (f = "start" === f ? -m[O] : -d[O]), (m = t.elements.arrow), (m = i && m ? u(m) : { width: 0, height: 0 });
						 var D = t.modifiersData["arrow#persistent"] ? t.modifiersData["arrow#persistent"].padding : { top: 0, right: 0, bottom: 0, left: 0 };
						 (v = D[v]),
							 (b = D[b]),
							 (m = Math.max(0, Math.min(d[O], m[O]))),
							 (E = c ? d[O] / 2 - j - m - v - h : E - m - v - h),
							 (c = c ? -d[O] / 2 + j + m + b + h : f + m + b + h),
							 (h = t.elements.arrow && g(t.elements.arrow)),
							 (d = t.modifiersData.offset ? t.modifiersData.offset[t.placement][p] : 0),
							 (h = l[p] + E - d - (h ? ("y" === p ? h.clientTop || 0 : h.clientLeft || 0) : 0)),
							 (c = l[p] + c - d),
							 (i = Math.max(i ? Math.min(w, h) : w, Math.min(o, i ? Math.max(x, c) : x))),
							 (l[p] = i),
							 (s[p] = i - o);
					 }
					 r && ((r = l[a]), (i = Math.max(r + n["x" === p ? "top" : "left"], Math.min(r, r - n["x" === p ? "bottom" : "right"]))), (l[a] = i), (s[a] = i - r)), (t.modifiersData[e] = s);
				 }
			 },
			 requiresIfExists: ["offset"],
		 },
		 Z = {
			 name: "arrow",
			 enabled: !0,
			 phase: "main",
			 fn: function (e) {
				 var t,
					 n = e.state;
				 e = e.name;
				 var r = n.elements.arrow,
					 o = n.modifiersData.popperOffsets,
					 i = y(n.placement),
					 a = M(i);
				 if (((i = 0 <= ["left", "right"].indexOf(i) ? "height" : "width"), r && o)) {
					 var s = n.modifiersData[e + "#persistent"].padding,
						 f = u(r),
						 c = "y" === a ? "top" : "left",
						 p = "y" === a ? "bottom" : "right",
						 l = n.rects.reference[i] + n.rects.reference[a] - o[a] - n.rects.popper[i];
					 (o = o[a] - n.rects.reference[a]),
						 (l = (r = (r = g(r)) ? ("y" === a ? r.clientHeight || 0 : r.clientWidth || 0) : 0) / 2 - f[i] / 2 + (l / 2 - o / 2)),
						 (i = Math.max(s[c], Math.min(l, r - f[i] - s[p]))),
						 (n.modifiersData[e] = (((t = {})[a] = i), (t.centerOffset = i - l), t));
				 }
			 },
			 effect: function (e) {
				 var t = e.state,
					 n = e.options;
				 e = e.name;
				 var r = n.element;
				 if (((r = void 0 === r ? "[data-popper-arrow]" : r), (n = void 0 === (n = n.padding) ? 0 : n), null != r)) {
					 if ("string" == typeof r && !(r = t.elements.popper.querySelector(r))) return;
					 O(t.elements.popper, r) && ((t.elements.arrow = r), (t.modifiersData[e + "#persistent"] = { padding: D("number" != typeof n ? n : P(n, T)) }));
				 }
			 },
			 requires: ["popperOffsets"],
			 requiresIfExists: ["preventOverflow"],
		 },
		 $ = {
			 name: "hide",
			 enabled: !0,
			 phase: "main",
			 requiresIfExists: ["preventOverflow"],
			 fn: function (e) {
				 var t = e.state;
				 e = e.name;
				 var n = t.rects.reference,
					 r = t.rects.popper,
					 o = t.modifiersData.preventOverflow,
					 i = L(t, { elementContext: "reference" }),
					 a = L(t, { altBoundary: !0 });
				 (n = R(i, n)),
					 (r = R(a, r, o)),
					 (o = S(n)),
					 (a = S(r)),
					 (t.modifiersData[e] = { referenceClippingOffsets: n, popperEscapeOffsets: r, isReferenceHidden: o, hasPopperEscaped: a }),
					 (t.attributes.popper = Object.assign(Object.assign({}, t.attributes.popper), {}, { "data-popper-reference-hidden": o, "data-popper-escaped": a }));
			 },
		 },
		 ee = B({ defaultModifiers: [_, U, F, X] }),
		 te = [_, U, F, X, Y, K, Q, Z, $],
		 ne = B({ defaultModifiers: te });
	 (e.applyStyles = X),
		 (e.arrow = Z),
		 (e.computeStyles = F),
		 (e.createPopper = ne),
		 (e.createPopperLite = ee),
		 (e.defaultModifiers = te),
		 (e.detectOverflow = L),
		 (e.eventListeners = _),
		 (e.flip = K),
		 (e.hide = $),
		 (e.offset = Y),
		 (e.popperGenerator = B),
		 (e.popperOffsets = U),
		 (e.preventOverflow = Q),
		 Object.defineProperty(e, "__esModule", { value: !0 });
 });
 
 /*==============================
		 Scroll Bar
 ============================== */
 /*!
 /*!
  * perfect-scrollbar v1.5.0
  * Copyright 2020 Hyunje Jun, MDBootstrap and Contributors
  * Licensed under MIT
  */ (function (a, b) {
	 "object" == typeof exports && "undefined" != typeof module ? (module.exports = b()) : "function" == typeof define && define.amd ? define(b) : ((a = a || self), (a.PerfectScrollbar = b()));
 })(this, function () {
	 "use strict";
	 var u = Math.abs,
		 v = Math.floor;
	 function a(a) {
		 return getComputedStyle(a);
	 }
	 function b(a, b) {
		 for (var c in b) {
			 var d = b[c];
			 "number" == typeof d && (d += "px"), (a.style[c] = d);
		 }
		 return a;
	 }
	 function c(a) {
		 var b = document.createElement("div");
		 return (b.className = a), b;
	 }
	 function d(a, b) {
		 if (!w) throw new Error("No element matching method supported");
		 return w.call(a, b);
	 }
	 function e(a) {
		 a.remove ? a.remove() : a.parentNode && a.parentNode.removeChild(a);
	 }
	 function f(a, b) {
		 return Array.prototype.filter.call(a.children, function (a) {
			 return d(a, b);
		 });
	 }
	 function g(a, b) {
		 var c = a.element.classList,
			 d = z.state.scrolling(b);
		 c.contains(d) ? clearTimeout(A[b]) : c.add(d);
	 }
	 function h(a, b) {
		 A[b] = setTimeout(function () {
			 return a.isAlive && a.element.classList.remove(z.state.scrolling(b));
		 }, a.settings.scrollingThreshold);
	 }
	 function j(a, b) {
		 g(a, b), h(a, b);
	 }
	 function k(a) {
		 if ("function" == typeof window.CustomEvent) return new CustomEvent(a);
		 var b = document.createEvent("CustomEvent");
		 return b.initCustomEvent(a, !1, !1, void 0), b;
	 }
	 function l(a, b, c, d, e) {
		 void 0 === d && (d = !0), void 0 === e && (e = !1);
		 var f;
		 if ("top" === b) f = ["contentHeight", "containerHeight", "scrollTop", "y", "up", "down"];
		 else if ("left" === b) f = ["contentWidth", "containerWidth", "scrollLeft", "x", "left", "right"];
		 else throw new Error("A proper axis should be provided");
		 m(a, c, f, d, e);
	 }
	 function m(a, b, c, d, e) {
		 var f = c[0],
			 g = c[1],
			 h = c[2],
			 i = c[3],
			 l = c[4],
			 m = c[5];
		 void 0 === d && (d = !0), void 0 === e && (e = !1);
		 var n = a.element; // reset reach
		 (a.reach[i] = null),
			 1 > n[h] && (a.reach[i] = "start"),
			 n[h] > a[f] - a[g] - 1 && (a.reach[i] = "end"),
			 b && (n.dispatchEvent(k("ps-scroll-" + i)), 0 > b ? n.dispatchEvent(k("ps-scroll-" + l)) : 0 < b && n.dispatchEvent(k("ps-scroll-" + m)), d && j(a, i)),
			 a.reach[i] && (b || e) && n.dispatchEvent(k("ps-" + i + "-reach-" + a.reach[i]));
	 }
	 function n(a) {
		 return parseInt(a, 10) || 0;
	 }
	 function o(a) {
		 return d(a, "input,[contenteditable]") || d(a, "select,[contenteditable]") || d(a, "textarea,[contenteditable]") || d(a, "button,[contenteditable]");
	 }
	 function p(b) {
		 var c = a(b);
		 return n(c.width) + n(c.paddingLeft) + n(c.paddingRight) + n(c.borderLeftWidth) + n(c.borderRightWidth);
	 }
	 function q(a) {
		 var b = Math.ceil,
			 c = a.element,
			 d = v(c.scrollTop),
			 g = c.getBoundingClientRect();
		 (a.containerWidth = b(g.width)),
			 (a.containerHeight = b(g.height)),
			 (a.contentWidth = c.scrollWidth),
			 (a.contentHeight = c.scrollHeight),
			 c.contains(a.scrollbarXRail) ||
				 (f(c, z.element.rail("x")).forEach(function (a) {
					 return e(a);
				 }),
				 c.appendChild(a.scrollbarXRail)),
			 c.contains(a.scrollbarYRail) ||
				 (f(c, z.element.rail("y")).forEach(function (a) {
					 return e(a);
				 }),
				 c.appendChild(a.scrollbarYRail)),
			 !a.settings.suppressScrollX && a.containerWidth + a.settings.scrollXMarginOffset < a.contentWidth
				 ? ((a.scrollbarXActive = !0),
				   (a.railXWidth = a.containerWidth - a.railXMarginWidth),
				   (a.railXRatio = a.containerWidth / a.railXWidth),
				   (a.scrollbarXWidth = r(a, n((a.railXWidth * a.containerWidth) / a.contentWidth))),
				   (a.scrollbarXLeft = n(((a.negativeScrollAdjustment + c.scrollLeft) * (a.railXWidth - a.scrollbarXWidth)) / (a.contentWidth - a.containerWidth))))
				 : (a.scrollbarXActive = !1),
			 !a.settings.suppressScrollY && a.containerHeight + a.settings.scrollYMarginOffset < a.contentHeight
				 ? ((a.scrollbarYActive = !0),
				   (a.railYHeight = a.containerHeight - a.railYMarginHeight),
				   (a.railYRatio = a.containerHeight / a.railYHeight),
				   (a.scrollbarYHeight = r(a, n((a.railYHeight * a.containerHeight) / a.contentHeight))),
				   (a.scrollbarYTop = n((d * (a.railYHeight - a.scrollbarYHeight)) / (a.contentHeight - a.containerHeight))))
				 : (a.scrollbarYActive = !1),
			 a.scrollbarXLeft >= a.railXWidth - a.scrollbarXWidth && (a.scrollbarXLeft = a.railXWidth - a.scrollbarXWidth),
			 a.scrollbarYTop >= a.railYHeight - a.scrollbarYHeight && (a.scrollbarYTop = a.railYHeight - a.scrollbarYHeight),
			 s(c, a),
			 a.scrollbarXActive ? c.classList.add(z.state.active("x")) : (c.classList.remove(z.state.active("x")), (a.scrollbarXWidth = 0), (a.scrollbarXLeft = 0), (c.scrollLeft = !0 === a.isRtl ? a.contentWidth : 0)),
			 a.scrollbarYActive ? c.classList.add(z.state.active("y")) : (c.classList.remove(z.state.active("y")), (a.scrollbarYHeight = 0), (a.scrollbarYTop = 0), (c.scrollTop = 0));
	 }
	 function r(a, b) {
		 var c = Math.min,
			 d = Math.max;
		 return a.settings.minScrollbarLength && (b = d(b, a.settings.minScrollbarLength)), a.settings.maxScrollbarLength && (b = c(b, a.settings.maxScrollbarLength)), b;
	 }
	 function s(a, c) {
		 var d = { width: c.railXWidth },
			 e = v(a.scrollTop);
		 (d.left = c.isRtl ? c.negativeScrollAdjustment + a.scrollLeft + c.containerWidth - c.contentWidth : a.scrollLeft),
			 c.isScrollbarXUsingBottom ? (d.bottom = c.scrollbarXBottom - e) : (d.top = c.scrollbarXTop + e),
			 b(c.scrollbarXRail, d);
		 var f = { top: e, height: c.railYHeight };
		 c.isScrollbarYUsingRight
			 ? c.isRtl
				 ? (f.right = c.contentWidth - (c.negativeScrollAdjustment + a.scrollLeft) - c.scrollbarYRight - c.scrollbarYOuterWidth - 9)
				 : (f.right = c.scrollbarYRight - a.scrollLeft)
			 : c.isRtl
			 ? (f.left = c.negativeScrollAdjustment + a.scrollLeft + 2 * c.containerWidth - c.contentWidth - c.scrollbarYLeft - c.scrollbarYOuterWidth)
			 : (f.left = c.scrollbarYLeft + a.scrollLeft),
			 b(c.scrollbarYRail, f),
			 b(c.scrollbarX, { left: c.scrollbarXLeft, width: c.scrollbarXWidth - c.railBorderXWidth }),
			 b(c.scrollbarY, { top: c.scrollbarYTop, height: c.scrollbarYHeight - c.railBorderYWidth });
	 }
	 function t(a, b) {
		 function c(b) {
			 b.touches && b.touches[0] && (b[k] = b.touches[0].pageY), (s[o] = t + v * (b[k] - u)), g(a, p), q(a), b.stopPropagation(), b.preventDefault();
		 }
		 function d() {
			 h(a, p), a[r].classList.remove(z.state.clicking), a.event.unbind(a.ownerDocument, "mousemove", c);
		 }
		 function f(b, e) {
			 (t = s[o]),
				 e && b.touches && (b[k] = b.touches[0].pageY),
				 (u = b[k]),
				 (v = (a[j] - a[i]) / (a[l] - a[n])),
				 e ? a.event.bind(a.ownerDocument, "touchmove", c) : (a.event.bind(a.ownerDocument, "mousemove", c), a.event.once(a.ownerDocument, "mouseup", d), b.preventDefault()),
				 a[r].classList.add(z.state.clicking),
				 b.stopPropagation();
		 }
		 var i = b[0],
			 j = b[1],
			 k = b[2],
			 l = b[3],
			 m = b[4],
			 n = b[5],
			 o = b[6],
			 p = b[7],
			 r = b[8],
			 s = a.element,
			 t = null,
			 u = null,
			 v = null;
		 a.event.bind(a[m], "mousedown", function (a) {
			 f(a);
		 }),
			 a.event.bind(a[m], "touchstart", function (a) {
				 f(a, !0);
			 });
	 }
	 var w = "undefined" != typeof Element && (Element.prototype.matches || Element.prototype.webkitMatchesSelector || Element.prototype.mozMatchesSelector || Element.prototype.msMatchesSelector),
		 z = {
			 main: "ps",
			 rtl: "ps__rtl",
			 element: {
				 thumb: function (a) {
					 return "ps__thumb-" + a;
				 },
				 rail: function (a) {
					 return "ps__rail-" + a;
				 },
				 consuming: "ps__child--consume",
			 },
			 state: {
				 focus: "ps--focus",
				 clicking: "ps--clicking",
				 active: function (a) {
					 return "ps--active-" + a;
				 },
				 scrolling: function (a) {
					 return "ps--scrolling-" + a;
				 },
			 },
		 },
		 A = { x: null, y: null },
		 B = function (a) {
			 (this.element = a), (this.handlers = {});
		 },
		 C = { isEmpty: { configurable: !0 } };
	 (B.prototype.bind = function (a, b) {
		 "undefined" == typeof this.handlers[a] && (this.handlers[a] = []), this.handlers[a].push(b), this.element.addEventListener(a, b, !1);
	 }),
		 (B.prototype.unbind = function (a, b) {
			 var c = this;
			 this.handlers[a] = this.handlers[a].filter(function (d) {
				 return !!(b && d !== b) || (c.element.removeEventListener(a, d, !1), !1);
			 });
		 }),
		 (B.prototype.unbindAll = function () {
			 for (var a in this.handlers) this.unbind(a);
		 }),
		 (C.isEmpty.get = function () {
			 var a = this;
			 return Object.keys(this.handlers).every(function (b) {
				 return 0 === a.handlers[b].length;
			 });
		 }),
		 Object.defineProperties(B.prototype, C);
	 var D = function () {
		 this.eventElements = [];
	 };
	 (D.prototype.eventElement = function (a) {
		 var b = this.eventElements.filter(function (b) {
			 return b.element === a;
		 })[0];
		 return b || ((b = new B(a)), this.eventElements.push(b)), b;
	 }),
		 (D.prototype.bind = function (a, b, c) {
			 this.eventElement(a).bind(b, c);
		 }),
		 (D.prototype.unbind = function (a, b, c) {
			 var d = this.eventElement(a);
			 d.unbind(b, c), d.isEmpty && this.eventElements.splice(this.eventElements.indexOf(d), 1);
		 }),
		 (D.prototype.unbindAll = function () {
			 this.eventElements.forEach(function (a) {
				 return a.unbindAll();
			 }),
				 (this.eventElements = []);
		 }),
		 (D.prototype.once = function (a, b, c) {
			 var d = this.eventElement(a),
				 e = function (a) {
					 d.unbind(b, e), c(a);
				 };
			 d.bind(b, e);
		 });
	 var E = {
			 isWebKit: "undefined" != typeof document && "WebkitAppearance" in document.documentElement.style,
			 supportsTouch: "undefined" != typeof window && ("ontouchstart" in window || ("maxTouchPoints" in window.navigator && 0 < window.navigator.maxTouchPoints) || (window.DocumentTouch && document instanceof window.DocumentTouch)),
			 supportsIePointer: "undefined" != typeof navigator && navigator.msMaxTouchPoints,
			 isChrome: "undefined" != typeof navigator && /Chrome/i.test(navigator && navigator.userAgent),
		 },
		 F = function () {
			 return {
				 handlers: ["click-rail", "drag-thumb", "keyboard", "wheel", "touch"],
				 maxScrollbarLength: null,
				 minScrollbarLength: null,
				 scrollingThreshold: 1e3,
				 scrollXMarginOffset: 0,
				 scrollYMarginOffset: 0,
				 suppressScrollX: !1,
				 suppressScrollY: !1,
				 swipeEasing: !0,
				 useBothWheelAxes: !1,
				 wheelPropagation: !0,
				 wheelSpeed: 1,
			 };
		 },
		 G = {
			 "click-rail": function (a) {
				 a.element;
				 a.event.bind(a.scrollbarY, "mousedown", function (a) {
					 return a.stopPropagation();
				 }),
					 a.event.bind(a.scrollbarYRail, "mousedown", function (b) {
						 var c = b.pageY - window.pageYOffset - a.scrollbarYRail.getBoundingClientRect().top,
							 d = c > a.scrollbarYTop ? 1 : -1;
						 (a.element.scrollTop += d * a.containerHeight), q(a), b.stopPropagation();
					 }),
					 a.event.bind(a.scrollbarX, "mousedown", function (a) {
						 return a.stopPropagation();
					 }),
					 a.event.bind(a.scrollbarXRail, "mousedown", function (b) {
						 var c = b.pageX - window.pageXOffset - a.scrollbarXRail.getBoundingClientRect().left,
							 d = c > a.scrollbarXLeft ? 1 : -1;
						 (a.element.scrollLeft += d * a.containerWidth), q(a), b.stopPropagation();
					 });
			 },
			 "drag-thumb": function (a) {
				 t(a, ["containerWidth", "contentWidth", "pageX", "railXWidth", "scrollbarX", "scrollbarXWidth", "scrollLeft", "x", "scrollbarXRail"]),
					 t(a, ["containerHeight", "contentHeight", "pageY", "railYHeight", "scrollbarY", "scrollbarYHeight", "scrollTop", "y", "scrollbarYRail"]);
			 },
			 keyboard: function (a) {
				 function b(b, d) {
					 var e = v(c.scrollTop);
					 if (0 === b) {
						 if (!a.scrollbarYActive) return !1;
						 if ((0 === e && 0 < d) || (e >= a.contentHeight - a.containerHeight && 0 > d)) return !a.settings.wheelPropagation;
					 }
					 var f = c.scrollLeft;
					 if (0 === d) {
						 if (!a.scrollbarXActive) return !1;
						 if ((0 === f && 0 > b) || (f >= a.contentWidth - a.containerWidth && 0 < b)) return !a.settings.wheelPropagation;
					 }
					 return !0;
				 }
				 var c = a.element,
					 f = function () {
						 return d(c, ":hover");
					 },
					 g = function () {
						 return d(a.scrollbarX, ":focus") || d(a.scrollbarY, ":focus");
					 };
				 a.event.bind(a.ownerDocument, "keydown", function (d) {
					 if (!((d.isDefaultPrevented && d.isDefaultPrevented()) || d.defaultPrevented) && (f() || g())) {
						 var e = document.activeElement ? document.activeElement : a.ownerDocument.activeElement;
						 if (e) {
							 if ("IFRAME" === e.tagName) e = e.contentDocument.activeElement;
							 // go deeper if element is a webcomponent
							 else for (; e.shadowRoot; ) e = e.shadowRoot.activeElement;
							 if (o(e)) return;
						 }
						 var h = 0,
							 i = 0;
						 switch (d.which) {
							 case 37:
								 h = d.metaKey ? -a.contentWidth : d.altKey ? -a.containerWidth : -30;
								 break;
							 case 38:
								 i = d.metaKey ? a.contentHeight : d.altKey ? a.containerHeight : 30;
								 break;
							 case 39:
								 h = d.metaKey ? a.contentWidth : d.altKey ? a.containerWidth : 30;
								 break;
							 case 40:
								 i = d.metaKey ? -a.contentHeight : d.altKey ? -a.containerHeight : -30;
								 break;
							 case 32:
								 i = d.shiftKey ? a.containerHeight : -a.containerHeight;
								 break;
							 case 33:
								 i = a.containerHeight;
								 break;
							 case 34:
								 i = -a.containerHeight;
								 break;
							 case 36:
								 i = a.contentHeight;
								 break;
							 case 35:
								 i = -a.contentHeight;
								 break;
							 default:
								 return;
						 }
						 (a.settings.suppressScrollX && 0 !== h) || (a.settings.suppressScrollY && 0 !== i) || ((c.scrollTop -= i), (c.scrollLeft += h), q(a), b(h, i) && d.preventDefault());
					 }
				 });
			 },
			 wheel: function (b) {
				 function c(a, c) {
					 var d,
						 e = v(h.scrollTop),
						 f = 0 === h.scrollTop,
						 g = e + h.offsetHeight === h.scrollHeight,
						 i = 0 === h.scrollLeft,
						 j = h.scrollLeft + h.offsetWidth === h.scrollWidth;
					 return (d = u(c) > u(a) ? f || g : i || j), !d || !b.settings.wheelPropagation;
				 }
				 function d(a) {
					 var b = a.deltaX,
						 c = -1 * a.deltaY;
					 return (
						 ("undefined" == typeof b || "undefined" == typeof c) && ((b = (-1 * a.wheelDeltaX) / 6), (c = a.wheelDeltaY / 6)),
						 a.deltaMode && 1 === a.deltaMode && ((b *= 10), (c *= 10)),
						 b !== b && c !== c /* NaN checks */ && ((b = 0), (c = a.wheelDelta)),
						 a.shiftKey ? [-c, -b] : [b, c]
					 );
				 }
				 function f(b, c, d) {
					 // FIXME: this is a workaround for <select> issue in FF and IE #571
					 if (!E.isWebKit && h.querySelector("select:focus")) return !0;
					 if (!h.contains(b)) return !1;
					 for (var e = b; e && e !== h; ) {
						 if (e.classList.contains(z.element.consuming)) return !0;
						 var f = a(e); // if deltaY && vertical scrollable
						 if (d && f.overflowY.match(/(scroll|auto)/)) {
							 var g = e.scrollHeight - e.clientHeight;
							 if (0 < g && ((0 < e.scrollTop && 0 > d) || (e.scrollTop < g && 0 < d))) return !0;
						 } // if deltaX && horizontal scrollable
						 if (c && f.overflowX.match(/(scroll|auto)/)) {
							 var i = e.scrollWidth - e.clientWidth;
							 if (0 < i && ((0 < e.scrollLeft && 0 > c) || (e.scrollLeft < i && 0 < c))) return !0;
						 }
						 e = e.parentNode;
					 }
					 return !1;
				 }
				 function g(a) {
					 var e = d(a),
						 g = e[0],
						 i = e[1];
					 if (!f(a.target, g, i)) {
						 var j = !1;
						 b.settings.useBothWheelAxes
							 ? b.scrollbarYActive && !b.scrollbarXActive
								 ? (i ? (h.scrollTop -= i * b.settings.wheelSpeed) : (h.scrollTop += g * b.settings.wheelSpeed), (j = !0))
								 : b.scrollbarXActive && !b.scrollbarYActive && (g ? (h.scrollLeft += g * b.settings.wheelSpeed) : (h.scrollLeft -= i * b.settings.wheelSpeed), (j = !0))
							 : ((h.scrollTop -= i * b.settings.wheelSpeed), (h.scrollLeft += g * b.settings.wheelSpeed)),
							 q(b),
							 (j = j || c(g, i)),
							 j && !a.ctrlKey && (a.stopPropagation(), a.preventDefault());
					 }
				 }
				 var h = b.element;
				 "undefined" == typeof window.onwheel ? "undefined" != typeof window.onmousewheel && b.event.bind(h, "mousewheel", g) : b.event.bind(h, "wheel", g);
			 },
			 touch: function (b) {
				 function c(a, c) {
					 var d = v(l.scrollTop),
						 e = l.scrollLeft,
						 f = u(a),
						 g = u(c);
					 if (g > f) {
						 // user is perhaps trying to swipe up/down the page
						 if ((0 > c && d === b.contentHeight - b.containerHeight) || (0 < c && 0 === d))
							 // set prevent for mobile Chrome refresh
							 return 0 === window.scrollY && 0 < c && E.isChrome;
					 } else if (f > g && ((0 > a && e === b.contentWidth - b.containerWidth) || (0 < a && 0 === e)))
						 // user is perhaps trying to swipe left/right across the page
						 return !0;
					 return !0;
				 }
				 function d(a, c) {
					 (l.scrollTop -= c), (l.scrollLeft -= a), q(b);
				 }
				 function f(a) {
					 return a.targetTouches ? a.targetTouches[0] : a;
				 }
				 function g(a) {
					 return (
						 !(a.pointerType && "pen" === a.pointerType && 0 === a.buttons) && (!!(a.targetTouches && 1 === a.targetTouches.length) || !!(a.pointerType && "mouse" !== a.pointerType && a.pointerType !== a.MSPOINTER_TYPE_MOUSE))
					 );
				 }
				 function h(a) {
					 if (g(a)) {
						 var b = f(a);
						 (m.pageX = b.pageX), (m.pageY = b.pageY), (n = new Date().getTime()), null !== p && clearInterval(p);
					 }
				 }
				 function i(b, c, d) {
					 if (!l.contains(b)) return !1;
					 for (var e = b; e && e !== l; ) {
						 if (e.classList.contains(z.element.consuming)) return !0;
						 var f = a(e); // if deltaY && vertical scrollable
						 if (d && f.overflowY.match(/(scroll|auto)/)) {
							 var g = e.scrollHeight - e.clientHeight;
							 if (0 < g && ((0 < e.scrollTop && 0 > d) || (e.scrollTop < g && 0 < d))) return !0;
						 } // if deltaX && horizontal scrollable
						 if (c && f.overflowX.match(/(scroll|auto)/)) {
							 var h = e.scrollWidth - e.clientWidth;
							 if (0 < h && ((0 < e.scrollLeft && 0 > c) || (e.scrollLeft < h && 0 < c))) return !0;
						 }
						 e = e.parentNode;
					 }
					 return !1;
				 }
				 function j(a) {
					 if (g(a)) {
						 var b = f(a),
							 e = { pageX: b.pageX, pageY: b.pageY },
							 h = e.pageX - m.pageX,
							 j = e.pageY - m.pageY;
						 if (i(a.target, h, j)) return;
						 d(h, j), (m = e);
						 var k = new Date().getTime(),
							 l = k - n;
						 0 < l && ((o.x = h / l), (o.y = j / l), (n = k)), c(h, j) && a.preventDefault();
					 }
				 }
				 function k() {
					 b.settings.swipeEasing &&
						 (clearInterval(p),
						 (p = setInterval(function () {
							 return b.isInitialized ? void clearInterval(p) : o.x || o.y ? (0.01 > u(o.x) && 0.01 > u(o.y) ? void clearInterval(p) : void (d(30 * o.x, 30 * o.y), (o.x *= 0.8), (o.y *= 0.8))) : void clearInterval(p);
						 }, 10)));
				 }
				 if (E.supportsTouch || E.supportsIePointer) {
					 var l = b.element,
						 m = {},
						 n = 0,
						 o = {},
						 p = null;
					 E.supportsTouch
						 ? (b.event.bind(l, "touchstart", h), b.event.bind(l, "touchmove", j), b.event.bind(l, "touchend", k))
						 : E.supportsIePointer &&
						   (window.PointerEvent
							   ? (b.event.bind(l, "pointerdown", h), b.event.bind(l, "pointermove", j), b.event.bind(l, "pointerup", k))
							   : window.MSPointerEvent && (b.event.bind(l, "MSPointerDown", h), b.event.bind(l, "MSPointerMove", j), b.event.bind(l, "MSPointerUp", k)));
				 }
			 },
		 },
		 H = function (d, e) {
			 var f = this;
			 if ((void 0 === e && (e = {}), "string" == typeof d && (d = document.querySelector(d)), !d || !d.nodeName)) throw new Error("no element is specified to initialize PerfectScrollbar");
			 for (var g in ((this.element = d), d.classList.add(z.main), (this.settings = F()), e)) this.settings[g] = e[g];
			 (this.containerWidth = null), (this.containerHeight = null), (this.contentWidth = null), (this.contentHeight = null);
			 var h = function () {
					 return d.classList.add(z.state.focus);
				 },
				 i = function () {
					 return d.classList.remove(z.state.focus);
				 };
			 (this.isRtl = "rtl" === a(d).direction),
				 !0 === this.isRtl && d.classList.add(z.rtl),
				 (this.isNegativeScroll = (function () {
					 var a = d.scrollLeft,
						 b = null;
					 return (d.scrollLeft = -1), (b = 0 > d.scrollLeft), (d.scrollLeft = a), b;
				 })()),
				 (this.negativeScrollAdjustment = this.isNegativeScroll ? d.scrollWidth - d.clientWidth : 0),
				 (this.event = new D()),
				 (this.ownerDocument = d.ownerDocument || document),
				 (this.scrollbarXRail = c(z.element.rail("x"))),
				 d.appendChild(this.scrollbarXRail),
				 (this.scrollbarX = c(z.element.thumb("x"))),
				 this.scrollbarXRail.appendChild(this.scrollbarX),
				 this.scrollbarX.setAttribute("tabindex", 0),
				 this.event.bind(this.scrollbarX, "focus", h),
				 this.event.bind(this.scrollbarX, "blur", i),
				 (this.scrollbarXActive = null),
				 (this.scrollbarXWidth = null),
				 (this.scrollbarXLeft = null);
			 var j = a(this.scrollbarXRail);
			 (this.scrollbarXBottom = parseInt(j.bottom, 10)),
				 isNaN(this.scrollbarXBottom) ? ((this.isScrollbarXUsingBottom = !1), (this.scrollbarXTop = n(j.top))) : (this.isScrollbarXUsingBottom = !0),
				 (this.railBorderXWidth = n(j.borderLeftWidth) + n(j.borderRightWidth)),
				 b(this.scrollbarXRail, { display: "block" }),
				 (this.railXMarginWidth = n(j.marginLeft) + n(j.marginRight)),
				 b(this.scrollbarXRail, { display: "" }),
				 (this.railXWidth = null),
				 (this.railXRatio = null),
				 (this.scrollbarYRail = c(z.element.rail("y"))),
				 d.appendChild(this.scrollbarYRail),
				 (this.scrollbarY = c(z.element.thumb("y"))),
				 this.scrollbarYRail.appendChild(this.scrollbarY),
				 this.scrollbarY.setAttribute("tabindex", 0),
				 this.event.bind(this.scrollbarY, "focus", h),
				 this.event.bind(this.scrollbarY, "blur", i),
				 (this.scrollbarYActive = null),
				 (this.scrollbarYHeight = null),
				 (this.scrollbarYTop = null);
			 var k = a(this.scrollbarYRail);
			 (this.scrollbarYRight = parseInt(k.right, 10)),
				 isNaN(this.scrollbarYRight) ? ((this.isScrollbarYUsingRight = !1), (this.scrollbarYLeft = n(k.left))) : (this.isScrollbarYUsingRight = !0),
				 (this.scrollbarYOuterWidth = this.isRtl ? p(this.scrollbarY) : null),
				 (this.railBorderYWidth = n(k.borderTopWidth) + n(k.borderBottomWidth)),
				 b(this.scrollbarYRail, { display: "block" }),
				 (this.railYMarginHeight = n(k.marginTop) + n(k.marginBottom)),
				 b(this.scrollbarYRail, { display: "" }),
				 (this.railYHeight = null),
				 (this.railYRatio = null),
				 (this.reach = {
					 x: 0 >= d.scrollLeft ? "start" : d.scrollLeft >= this.contentWidth - this.containerWidth ? "end" : null,
					 y: 0 >= d.scrollTop ? "start" : d.scrollTop >= this.contentHeight - this.containerHeight ? "end" : null,
				 }),
				 (this.isAlive = !0),
				 this.settings.handlers.forEach(function (a) {
					 return G[a](f);
				 }),
				 (this.lastScrollTop = v(d.scrollTop)),
				 (this.lastScrollLeft = d.scrollLeft),
				 this.event.bind(this.element, "scroll", function (a) {
					 return f.onScroll(a);
				 }),
				 q(this);
		 };
	 return (
		 (H.prototype.update = function () {
			 this.isAlive && // Recalcuate negative scrollLeft adjustment
				 // Recalculate rail margins
				 // Hide scrollbars not to affect scrollWidth and scrollHeight
				 ((this.negativeScrollAdjustment = this.isNegativeScroll ? this.element.scrollWidth - this.element.clientWidth : 0),
				 b(this.scrollbarXRail, { display: "block" }),
				 b(this.scrollbarYRail, { display: "block" }),
				 (this.railXMarginWidth = n(a(this.scrollbarXRail).marginLeft) + n(a(this.scrollbarXRail).marginRight)),
				 (this.railYMarginHeight = n(a(this.scrollbarYRail).marginTop) + n(a(this.scrollbarYRail).marginBottom)),
				 b(this.scrollbarXRail, { display: "none" }),
				 b(this.scrollbarYRail, { display: "none" }),
				 q(this),
				 l(this, "top", 0, !1, !0),
				 l(this, "left", 0, !1, !0),
				 b(this.scrollbarXRail, { display: "" }),
				 b(this.scrollbarYRail, { display: "" }));
		 }),
		 (H.prototype.onScroll = function () {
			 this.isAlive &&
				 (q(this),
				 l(this, "top", this.element.scrollTop - this.lastScrollTop),
				 l(this, "left", this.element.scrollLeft - this.lastScrollLeft),
				 (this.lastScrollTop = v(this.element.scrollTop)),
				 (this.lastScrollLeft = this.element.scrollLeft));
		 }),
		 (H.prototype.destroy = function () {
			 this.isAlive && // unset elements
				 (this.event.unbindAll(),
				 e(this.scrollbarX),
				 e(this.scrollbarY),
				 e(this.scrollbarXRail),
				 e(this.scrollbarYRail),
				 this.removePsClasses(),
				 (this.element = null),
				 (this.scrollbarX = null),
				 (this.scrollbarY = null),
				 (this.scrollbarXRail = null),
				 (this.scrollbarYRail = null),
				 (this.isAlive = !1));
		 }),
		 (H.prototype.removePsClasses = function () {
			 this.element.className = this.element.className
				 .split(" ")
				 .filter(function (a) {
					 return !a.match(/^ps([-_].+|)$/);
				 })
				 .join(" ");
		 }),
		 H
	 );
 });
 