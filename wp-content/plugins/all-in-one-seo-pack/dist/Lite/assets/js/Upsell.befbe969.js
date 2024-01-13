import{S as m}from"./Profile.9076f6b1.js";import{x as o,o as r,c as h,k as u,l as a,D as c,t as l,C as g}from"./vue.runtime.esm-bundler.4a881941.js";import{_}from"./_plugin-vue_export-helper.abeb2ae0.js";import{f as v}from"./links.7c59a081.js";import{C as y}from"./Index.03e7c6f4.js";import{R as x}from"./RequiredPlans.197cbabd.js";const $={components:{SvgDannieProfile:m},props:{src:String,size:{required:!0,type:Number}}},S=["src","width","height"];function k(s,p,t,i,e,d){const n=o("svg-dannie-profile");return t.src?(r(),h("img",{key:0,src:t.src,width:t.size,height:t.size,alt:"avatar",loading:"lazy",decoding:"async",class:"aioseo-user-avatar"},null,8,S)):(r(),u(n,{key:1,width:t.size,height:t.size,class:"aioseo-user-avatar aioseo-user-avatar--dannie"},null,8,["width","height"]))}const P=_($,[["render",k],["__scopeId","data-v-4705aae0"]]),U={setup(){return{licenseStore:v()}},components:{Cta:y,RequiredPlans:x},props:{parentComponentContext:String},data(){return{strings:{ctaHeader:this.$t.sprintf(this.$t.__("SEO Revisions is a %1$s Feature",this.$td),"PRO"),ctaDescription:this.$t.__("Our powerful revisions feature provides a valuable record of SEO updates, allowing you to monitor the effectiveness of your SEO efforts and make informed decisions.",this.$td),ctaFeatures:[this.$t.__("Improved SEO strategy",this.$td),this.$t.__("Easy to manage revisions",this.$td),this.$t.__("Greater transparency and accountability",this.$td),this.$t.__("Historical record of optimization efforts",this.$td)],ctaButtonText:this.$t.__("Unlock SEO Revisions",this.$td)}}}};function C(s,p,t,i,e,d){const n=o("required-plans"),f=o("cta");return r(),u(f,{"cta-link":s.$links.getPricingUrl("seo-revisions","seo-revisions",t.parentComponentContext),"button-text":e.strings.ctaButtonText,"learn-more-link":s.$links.getUpsellUrl("seo-revisions",t.parentComponentContext,s.$isPro?"pricing":"liteUpgrade"),"feature-list":e.strings.ctaFeatures,"hide-bonus":!i.licenseStore.isUnlicensed},{"header-text":a(()=>[c(l(e.strings.ctaHeader),1)]),description:a(()=>[g(n,{"core-feature":["seo-revisions"]}),c(" "+l(e.strings.ctaDescription),1)]),_:1},8,["cta-link","button-text","learn-more-link","feature-list","hide-bonus"])}const A=_(U,[["render",C]]);export{A as S,P as U};
