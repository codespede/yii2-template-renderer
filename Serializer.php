<?php

namespace cs\templaterenderer;

class Serializer extends \yii\rest\Serializer
{
    /**
     * {@inheritdoc}
     */
    public function serialize($data)
    {
        if ($data instanceof Model && $data->hasErrors()) {
            return $this->serializeModelErrors($data);
        } elseif ($data instanceof Arrayable) {
            return $this->serializeModel($data);
        } elseif ($data instanceof DataProviderInterface) {
            return $this->serializeDataProvider($data);
        } elseif ($data instanceof TemplateRenderer){
            return $this->serializeTemplateRenderer($data);
        }

        return $data;
    }
    
    /**
     * Serializes a template renderer
     * @param TemplateRenderer $templateRenderer
     * @return string the rendered template of the dataProvider
     */
    public function serializeTemplateRenderer($templateRenderer){
        $templateRenderer->dataProvider->prepare(true);
        if (($pagination = $templateRenderer->dataProvider->getPagination()) !== false) {
            $this->addPaginationHeaders($pagination);
        }
        return $templateRenderer::widget(get_object_vars($templateRenderer));
    }
}
